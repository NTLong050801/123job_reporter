<?php
namespace Workable\RobotLog\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Workable\RobotLog\Models\RobotVisit;
use Workable\RobotLog\Services\RobotCounterService;

class RobotCounterVisitCommand extends Command
{
    private $robotCounterService;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'robot-counter:count-visit
    {--date= : ngày muốn lấy thống kê, format : 2021-06-15} 
    {--start_date= : ngày bắt đầu, format : 2021-06-15} 
    {--end_date= : ngày kết thúc, format : 2021-06-15}
    {--before_date=0 : chạy thống kê cho ngày hôm trc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';


    private $listApp;

    public function __construct(RobotCounterService $robotCounterService)
    {
        parent::__construct();
        $this->robotCounterService = $robotCounterService;

        $this->listApp = config('plugins.google-log.config.app');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dates = $this->__getDate();
        foreach ($dates as $date)
        {
            $this->__processItemDate($date);
        }
    }

    private function __getDate()
    {
        $startDate  = $this->option('start_date');
        $endDate    = $this->option('end_date');
        $beforeDate = $this->option('before_date');
        $date       = $this->option('date');
        $dates      = [];

        if($date) {
            $dates[] = $date;
        }
        else if($beforeDate) {
            $dates[] = now()->subDay()->format('Y-m-d');
        }
        else if($startDate && $endDate)
        {
            $interval = new \DateInterval('P1D');
            $period = new \DatePeriod(new \DateTime($startDate), $interval, (new \DateTime($endDate))->add($interval));

            foreach ($period as $key => $day) {
                $date = $day->format('Y-m-d');
                $dates[] = $date;
            }
        }
        else $dates[] = now()->format('Y-m-d');

        return $dates;
    }

    private function __processItemDate($date)
    {
        $this->info('-- Count robot visit in date: '. $date);
        $time = \FilterHelper::getStartEndTimeFromDate($date);

        RobotVisit::where('visited_at', '>=', $time['start'])
            ->where('visited_at', '<=', $time['end'])
            ->where('report_status', 0)
            ->chunkById(100, function ($robotVisits) use ($date)
            {
                $dataDate = [];
                $dateIds  = [];
                foreach ($robotVisits as $robotVisit)
                {
                    $this->__processItemVisit($robotVisit, $date, $dataDate);
                    $dateIds[] = $robotVisit->id;
                }

                $this->store($dataDate);
                $this->updateStatus($dateIds);

            });
    }

    private function updateStatus($ids)
    {
        DB::table("robot_visits")
            ->whereIn("id", $ids)
            ->update([
                "report_status" => 1
            ]);
    }

    private function store($dataDate)
    {
        if (empty($dataDate)) return false;

        foreach ($dataDate as $appInt => $dataApp)
        {
            $appText = $this->listApp[$appInt];
            $this->info('-- Process robot counter for app: '.$appText);

            foreach ($dataApp as $bot => $dataBot)
            {
                foreach ($dataBot as $path => $dataPath)
                {
                    $this->robotCounterService->updateOrCreate($dataPath);
                }
            }
        }

    }

    private function __processItemVisit($robotVisit, $date, &$dataDate)
    {
        $bot          = $robotVisit->bot;
        $app_int      = $robotVisit->app_int;
        $app_text     = $this->listApp[$app_int];
        $path         = $robotVisit->path;
        $labelPage    = $robotVisit->label_page;
        $execute_time = $robotVisit->execute_time;

        $dataPath = $dataDate[$app_int][$bot][$path] ?? [];
        if(!$dataPath)
        {
            $totalVisit     = 1;
            $totalTime      = $execute_time;
            $minExecuteTime = $execute_time;
            $maxExecuteTime = $execute_time;
            $avgExecuteTime = $execute_time;
        }
        else
        {
            $minExecuteTime = $dataPath['min_execute_time'];
            $minExecuteTime = ($execute_time <= $minExecuteTime) ? $execute_time : $minExecuteTime;

            $maxExecuteTime = $dataPath['max_execute_time'];
            $maxExecuteTime = ($execute_time >= $maxExecuteTime) ? $execute_time : $maxExecuteTime;

            $totalTime  = $dataPath['total_time'] + $execute_time;
            $totalVisit = $dataPath['total_visit'] + 1;

            $avgExecuteTime = (int)($totalTime / $totalVisit);
        }

        $dataPath = [
            'app_int'          => $app_int,
            'app_text'         => $app_text,
            'bot'              => $bot,
            'total_visit'      => $totalVisit,
            'total_time'       => $totalTime,
            'date'             => $date,
            'path'             => $path,
            'label_page'       => $labelPage,
            'min_execute_time' => $minExecuteTime,
            'max_execute_time' => $maxExecuteTime,
            'avg_execute_time' => $avgExecuteTime,
        ];
        $dataDate[$app_int][$bot][$path] = $dataPath;
    }
}

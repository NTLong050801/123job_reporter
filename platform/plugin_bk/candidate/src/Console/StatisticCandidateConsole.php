<?php

namespace Workable\Candidate\Console;

use Illuminate\Console\Command;
use Workable\Base\Supports\CliEcho;
use Workable\Candidate\Services\Statistic\StatisticService;

class StatisticCandidateConsole extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'candidate:statistic-candidate
                            {--type=all : Loại thống kê: all,candidate, career, rank, degree}
                            {--today : Ngày hôm nay}
                            {--date= : Ngày thống kê chỉ định}
                            {--date_start= : Ngày bắt đầu}
                            {--date_end= : Ngày kết thúc}';

    //php artisan db:seed --class=Workable\\Candidate\\Database\\Seeders\\ReportCvSeeder

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Thống kê dữ liệu ứng viên';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->option('type');
        switch ($type)
        {
            case 'all':
                $this->statisticCvReport();
                $this->statisticColumnReport('career');
                $this->statisticColumnReport('rank');
                $this->statisticColumnReport('degree');
                break;
            case 'cv':
                $this->statisticCvReport();
                break;
            case 'career':
                $this->statisticColumnReport('career');
                break;
            case 'rank':
                $this->statisticColumnReport('rank');
                break;
            case 'degree':
                $this->statisticColumnReport('degree');
                break;
        }
    }

    /**
     * Thống kê cv theo tháng
     */
    private function statisticCvReport()
    {
        $statisticService = new StatisticService();
        $data             = $statisticService->statisticCandidate();
        foreach ($data as $item)
        {
            $statisticService->saveCvReport($item);
        }
    }

    private function statisticColumnReport(string $column)
    {
        $date       = $this->option('date');
        $date_start = $this->option('date_start');
        $date_end   = $this->option('date_end');
        $today      = $this->option('today');
        if ($today)
        {
            $date = date('Y-m-d');
        }
        if (empty($date) && empty($date_start) && empty($date_end) && empty($today))
        {
            //Thống kê từ đầu đến cuối
            $data_range = $this->getDateRange();
            $date_start = date('Y-m-d', strtotime($data_range->start));
            $date_end   = date('Y-m-d', strtotime($data_range->end));
        }
        $statisticService = new StatisticService();
        if ($date)
        {
            $data   = $statisticService->statisticFollowColumn($column, $date);
            $result = $statisticService->saveReportFollowColumn($data, $column);
            if (empty($result))
            {
                CliEcho::infonl('--Không có dữ liệu mới để thống kê. Ngày ' . $date);
            }
        }
        elseif ($date_start && $date_end)
        {
            while (strtotime($date_start) <= strtotime($date_end))
            {
                $data = $statisticService->statisticFollowColumn($column, $date_start);
                $statisticService->saveReportFollowColumn($data, $column);
                $date_start = date("Y-m-d", strtotime("+1 day", strtotime($date_start)));
            }
        }
        else
        {
            CliEcho::errornl('--Error');
        }
    }

    private function getDateRange()
    {
        return \DB::table('candidates')->selectRaw("min(added_at) as `start` ,max(added_at) as `end`")->first();
    }
}

<?php
namespace Workable\GoogleLog\Console;

use Illuminate\Console\Command;
use Workable\GoogleLog\Enum\GoogleLogEnum;
use Workable\GoogleLog\Services\GoogleAnalystBaseService;
use Workable\GoogleLog\Services\GoogleLogService;

class GAGetDataUserCommand extends Command
{
    private $googleAnalystBaseService;
    private $googleLogService;
    private $pagePath = [];
    private $baseData = [];
    private $labelPage;
    private $config;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'google-log:get-data-ga-user
                {--label_page= : nhãn page lấy thống kê, ví dụ : job} 
                {--path= : path url lấy thống kê, ví dụ : /tuyen-dung} 
                {--date= : ngày muốn lấy thống kê, format : 2021-06-15} 
                {--start_date= : ngày bắt đầu, format : 2021-06-15} 
                {--end_date= : ngày kết thúc, format : 2021-06-15}
                {--before_date=0 : chạy thống kê cho ngày hôm trc}
                {--app_int=1 : app cần thống kê}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GoogleLogService $googleLogService)
    {
        parent::__construct();
        $this->googleAnalystBaseService = new GoogleAnalystBaseService();
        $this->googleLogService         = $googleLogService;
        $this->config                   = config('plugins.google-log.config');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->__setBaseData();
        $dates = $this->__getDates();

        foreach ($dates as $date)
        {
            $this->__processItemDate($date);
        }
    }

    private function __getDates()
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

    private function __setBaseData()
    {
        $appInt         = $this->option('app_int');
        $this->baseData = [
            'app_int'    => $appInt,
            'app_text'   => $this->config['app'][$appInt],
        ];
    }

    /**
     * Get data theo ngày
     * @param $date
     * @return bool
     */
    private function __processItemDate($date)
    {
        $this->info('-- Get data GA for date: '. $date);

        $labelPage = $this->option('label_page');

        $configLabel = array_keys($this->config['page']);

        if($labelPage) {
            if(!in_array($labelPage, $configLabel))
            {
                $this->error("-- Nhãn Page không đúng hoặc chưa được thêm vào cấu hình");
                return false;
            }

            $this->__processItemLabelPage($labelPage, $date);
        }
        else
        {
            foreach ($configLabel as $labelPage)
            {
                $this->__processItemLabelPage($labelPage, $date);
            }
        }
    }

    /**
     * Get data theo label page
     * @param $labelPage
     * @param $date
     * @return bool
     */
    private function __processItemLabelPage($labelPage, $date)
    {
        $this->info('-- Process for label page: '. $labelPage);
        $this->labelPage = $labelPage;

        if($path = $this->option('path'))
        {
            if(in_array($path, $this->config['page'][$labelPage])) $this->pagePath[] = $path;
        }
        else
            $this->pagePath = $this->config['page'][$labelPage] ?? [];

        if(!$this->pagePath)
        {
            $this->warn("-- Không có page path tương ứng với label page này");
            return false;
        }

        foreach ($this->pagePath as $itemPath)
        {
            $this->__processItemPath($date, $itemPath);
        }

    }

    /**
     * Get data theo từng path của label_page
     * @param $date
     * @param $path
     * @return bool
     */
    private function __processItemPath($date, $path)
    {
        $this->info('--- Process path: '. $path);

        $option = [
            'filters'    => 'ga:pagePath=@' . $path
        ];

        $metrics = 'ga:users, ga:sessions, ga:pageviews, ga:bounceRate, ga:newUsers';
        $param = [
            'option'     => $option,
            'metric'     => $metrics,
            'start_date' => $date,
            'end_date'   => $date,
        ];
        $data = $this->googleAnalystBaseService->getData($param);
        $data = $data->getRows();

        if(!is_array($data) || !$data) return false;

        $this->__saveData($date, $path, $data[0]);
    }

    private function __saveData($date, $path, array $data)
    {
        $dataUser = [
            GoogleLogEnum::LOG_USER        => [
                'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_USER],
                'hit'      => $data[0]
            ],
            GoogleLogEnum::LOG_SESSION     => [
                'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_SESSION],
                'hit'      => $data[1]
            ],
            GoogleLogEnum::LOG_PAGE_VIEW   => [
                'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_PAGE_VIEW],
                'hit'      => $data[2]
            ],
            GoogleLogEnum::LOG_BOUNCE_RATE => [
                'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_BOUNCE_RATE],
                'hit'      => round($data[3], 2)
            ],
            GoogleLogEnum::LOG_NEW_USER => [
                'log_text' => GoogleLogEnum::LOG[GoogleLogEnum::LOG_NEW_USER],
                'hit'      => $data[4], 2
            ],
        ];

        foreach ($dataUser as $log_int => $value)
        {
            $log_text = $value['log_text'];
            $this->info("-- GA save data metric: " . $log_text);


            $dataStore = array_merge($this->baseData, [
                'hit'               => $value['hit'],
                'log_int'           => $log_int,
                'log_text'          => $log_text,
                'source_created_at' => $date,
                'path'              => $path,
                'label_page'        => $this->labelPage
            ]);
            $this->__updateOrInsert($dataStore);
        }
    }

    private function __updateOrInsert($dataStore=[])
    {
        return $this->googleLogService->updateOrCreate($dataStore);
    }
}

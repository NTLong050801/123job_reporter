<?php

namespace Modules\Collect\Console\Commands\Crawl;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Collect\Core\CrawlDataManager;

class WorkerCrawlDataSourceCommand extends Command
{
    protected $signature = 'worker-get-data:run {country}
                            {--process=upload_public}
                            {--date_range=now}';

    protected $description = 'Worker get data upload/public';
    private $paramQuery = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //php artisan worker-get-data:run us  --date_range=now
        $this->info("-- Begin workerGetUploadPublic");
       $this->__initQuery()->__run();

       $this->info("-- Done workerGetUploadPublic!!!");
    }

    private function __run()
    {
        $country          = $this->argument('country') ;// = us
        $process          = $this->option('process'); // = upload_public
        $sourceData       = $this->__getConfigSpider($country, $process); //array data us - upload_public

        $crawlDataManager = new CrawlDataManager();
        $crawlDataManager
           ->country($country)
           ->run($sourceData, $this->paramQuery);

        //$this->paramQuery =  ["date_range" => "2022-08-18 10:36:17 - 2022-08-18 10:36:17"
        //          "country" => "us"
        //         "process" => "upload_public"]
    }

    private function __initQuery(): WorkerCrawlDataSourceCommand
    {

        $country   = $this->argument('country');
        $process   = $this->option('process');
        $dateRange = $this->option('date_range');

        if ($dateRange == 'now')
        {
            $now       = Carbon::now()->toDateTimeString();
            $dateRange = $now . ' - ' . $now;
        }
        $this->paramQuery['date_range'] = $dateRange;
        $this->paramQuery['country']    = $country;
        $this->paramQuery['process']    = $process;
        return $this;
        // "date_range" => "2022-08-18 10:36:17 - 2022-08-18 10:36:17"
        //  "country" => "us"
        //  "process" => "upload_public"
    }

    private function __getConfigSpider($country = '', $process = '')
    {
        $config = config('api.spider');
        //array
       return $config[$country][$process];
       //array:4 [
        //  "active" => 1
        //  "host" => "210.245.83.66:5001"
        //  "access_token" => "YRMHetweG7VTEryR4OonSN7XYVC5uJjNeheX3jTiUs"
        //  "api" => ""
        //]
    }
}

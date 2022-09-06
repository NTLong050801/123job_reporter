<?php

namespace Modules\Monitor\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Modules\Monitor\Core\MonitorManager;
use Modules\Monitor\Service\MonitorService;


class WorkerCrawMonitorCommand extends Command
{

    protected $signature = 'worker-get-data-monitor:run {--country=} {--id=}';


    protected $description = 'Worker get data Monitor';
    private $paramQuery = [];


    private $monitorService;

    public function __construct()
    {
        parent::__construct();
        $this->monitorService = app(MonitorService::class);
    }

    public function handle()
    {
        $this->info("-- Begin workerGetMonitor");

        if ($this->option('country'))
        {
            $country = $this->option('country');
            $site_id = DB::table('sites')
                ->where('country', $country)
                ->value('id');
            $filter  = [
                ['site_id', '=', $site_id]
            ];

            $items = $this->monitorService->getList($filter);
        }
        elseif ($this->option('id'))
        {
            $id     = $this->option('id');
            $filter = [
                ['id', '=', $id]
            ];

            $items = $this->monitorService->getList($filter);
        }
        else
        {
            $items = $this->monitorService->getList();
        }

        foreach ($items as $item)
        {
            $payload = json_decode($item->payload_rule, true) ?? [];
            $this->__initQuery($payload)
                ->__run($item);
        }

        $this->info("-- Done workerGetMonitor!!!");
    }

    private function __run($item)
    {
        $country    = $this->option('country');
        $sourceData = [
            "api"  => $item["url"],
            "host" => $item["name"]
        ];

        $header  = json_decode($item->additional_headers, true);
        $monitor = new MonitorManager();
        $monitor->country($country)
            ->run($item, $sourceData, $this->paramQuery, $header);
    }

    private function __initQuery($payloads)
    {
        $country = $this->option('country');

        $this->paramQuery['country'] = $country;
        $this->paramQuery['payload'] = $payloads;

        return $this;
    }
}

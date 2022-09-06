<?php

namespace Modules\Monitor\Core\Crawl;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Modules\Monitor\Core\Contracts\MonitorDataAbstract;
use Modules\Monitor\Enum\MonitorMethodCheckEnum;
use Modules\Monitor\Service\MonitorService;
use Workable\Base\Supports\CliEcho;

class MonitorData extends MonitorDataAbstract
{
    public function process($item = [], $paramQuery = [], $header = [])
    {
        $this->__requestUrl($item, $this->url, $paramQuery, $header);
    }

    private function __requestUrl($item, $url, $paramQuery = [], $header = []): void
    {
        $urlLog = $url . '?' . http_build_query($paramQuery);
        $this->__log("-- Request url job: " . ($urlLog ?: "Empty"));
        if (!$url) return;

        $time_start = microtime(true);

        switch ($item->uptime_check_method)
        {
            default:
            case MonitorMethodCheckEnum::GET_METHOD:
                $results = $this->_requestGet($url, $paramQuery, $header);
                break;

            case MonitorMethodCheckEnum::POST_METHOD:
                $results = $this->_requestPost($url, $paramQuery, $header);
                break;

            case MonitorMethodCheckEnum::HEAD_METHOD:
            case MonitorMethodCheckEnum::DELETE_METHOD:
                $results = null;
                break;
        }

        $time_end = microtime(true);
        $uptime   = (int)round(($time_end - $time_start) * 1000);
        $status   = $results->getStatusCode();

        $dataItems['uptime_status'] = $status;
        $dataItems['uptime']        = $uptime;
        $dataItems['last_check']    = Carbon::now()->toDateTimeString();
        $dataItems['data']          = $results->getBody()->getContents();

        $totalRecord = count($dataItems);

        $this->__logging($url, $totalRecord);
        if (!$totalRecord) return;

        $this->__processItems($item, $dataItems, Arr::get($paramQuery, 'process'));
    }

    private function __processItems($item, $dataItems, $process)
    {
        $monitorService = app(MonitorService::class);
        $monitorService->updateApi($item, $dataItems, $process, $this->country);
    }

    private function __log($message)
    {
        CliEcho::infonl($message);
    }

    private function __logging($uri, $totalRecord)
    {
        $message = "-- Get source: [Site] - request: [" . $uri . "] - total: " . $totalRecord;
        $this->__log($message);
    }
}

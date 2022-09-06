<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 05/07/2022
 * Time: 09:56
 */

namespace Modules\Collect\Core\Crawl;

use CliEcho;
use Illuminate\Support\Arr;
use Modules\Collect\Core\Contracts\CrawlDataAbstract;
use Modules\Collect\Core\Jobs\CrawlDataProcessJob;

class CrawlData extends CrawlDataAbstract
{

    public function process($paramQuery = [], $header = [])
    {
        //
        $this->__requestUrl($this->url, $paramQuery, $header);
    }

    private function __requestUrl($url, $paramQuery = [], $header = []): void
    {
        //$url = '';
        //http_build_query($paramQuery) => buil thanh 1 chuoi URL
        // "date_range=2022-08-18+10%3A58%3A55+-+2022-08-18+10%3A58%3A55&country=us&process=upload_public"
        $urlLog = $url . '?' . http_build_query($paramQuery);
        //
        $this->__log("-- Request url job: " . ($urlLog ?: "Empty"));
        if (!$url)  ;

        $results     = $this->_requestGet($url, $paramQuery);
        $dataItems   = $results['data'] ?? [];
        $totalRecord = count($dataItems); // số bản ghi
        $this->__logging($url, $totalRecord);
        if (!$totalRecord) return;
        //dd($results);
        $this->__processItems($dataItems, Arr::get($paramQuery, 'process'));
    }

    private function __processItems($items, $process)
    {
//        echo 'items : ';
       //dd($items);
        $queueJob = new CrawlDataProcessJob($items, $process, $this->country);
        // dispatch : helper
        dispatch($queueJob)->onQueue(make_queue_name('queue-process-data-crawl'));
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

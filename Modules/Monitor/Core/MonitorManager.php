<?php

namespace Modules\Monitor\Core;

use Modules\Collect\Core\Crawl\CrawlData;
use Modules\Monitor\Core\Contracts\MonitorDataAbstract;
use Modules\Monitor\Core\Crawl\MonitorData;

class MonitorManager
{
    protected $country;

    public function country($country): MonitorManager
    {
        $this->country = $country;
        return $this;
    }

    public function run($item, $sourceData = [], $paramQuery = [], $header = [])
    {
        $urlApi      = $sourceData['api'];
        $monitorData = new MonitorData();
        $monitorData->setCountry($this->country)
            ->setSourceCrawl($sourceData)
            ->setUrl($urlApi)
            ->process($item, $paramQuery, $header);
    }
}

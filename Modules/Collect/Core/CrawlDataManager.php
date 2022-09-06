<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 2022/02/28 - 11:49
 */

namespace Modules\Collect\Core;

use Modules\Collect\Core\Crawl\CrawlData;

class CrawlDataManager
{
    protected $country;

    public function country($country): CrawlDataManager
    {
        $this->country = $country;// =us
        return $this;
    }

    public function run($sourceCrawl = [], $paramQuery = [], $header = [])
    {
        //$sourceCrawl = array:4 [
        //  "active" => 1
        //  "host" => "210.245.83.66:5001"
        //  "access_token" => "YRMHetweG7VTEryR4OonSN7XYVC5uJjNeheX3jTiUs"
        //  "api" => ""
        //]
        // $paramQuery = [
        // "date_range" => "2022-08-18 10:36:17 - 2022-08-18 10:36:17"
        //  "country" => "us"
        //  "process" => "upload_public"
        //]
        $urlApi      = $sourceCrawl['api'];
        $accessToken = $sourceCrawl['access_token'];

        $crawlData = new CrawlData();
        $crawlData->setCountry($this->country)
            ->setSourceCrawl($sourceCrawl) //
            ->setUrl($urlApi, $accessToken)
            ->process($paramQuery, $header);

    }
}

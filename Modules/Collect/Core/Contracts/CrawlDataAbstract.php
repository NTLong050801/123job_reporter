<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 2022/02/28 - 11:56
 */

namespace Modules\Collect\Core\Contracts;

use Modules\Collect\Core\Traits\CrawlRequestHttpTrait;
use Workable\Support\Http\HttpBuilder;

abstract class CrawlDataAbstract
{
    use CrawlRequestHttpTrait;

    protected $betweenRequest = 1;
    protected $country = "";
    protected $url = "";
    protected $accessToken = "";
    protected $sourceCrawl = [];
    protected $httpBuilder;


    public function __construct()
    {
        $this->httpBuilder = new HttpBuilder();
    }

    public function setSourceCrawl($sourceCrawl = []): CrawlDataAbstract
    {
        $this->sourceCrawl = $sourceCrawl;
        return $this;
    }

    public function setCountry($country): CrawlDataAbstract
    {
        $this->country = $country;
        return $this;
    }

    public function setUrl($url, $token): CrawlDataAbstract
    {
        $this->url         = $url;
        $this->accessToken = $token;
        return $this;
    }

    //$sourceCrawl = array:4 [
    //  "active" => 1
    //  "host" => "210.245.83.66:5001"
    //  "access_token" => "YRMHetweG7VTEryR4OonSN7XYVC5uJjNeheX3jTiUs"
    //  "api" => ""
    //]
    private function __getHost()
    {
        return $this->sourceCrawl['host'];
    }

    private function __parseResult($result)
    {
        return $this->httpBuilder->getDataResponse($result);
    }

    protected function _requestGet($url, $paramQuery = [], $header = [])
    {
        //$paramQ = [
        // "date_range" => "2022-08-18 10:36:17 - 2022-08-18 10:36:17"
        //        "country" => "us"
        //        "process" => "upload_public"]
        $host            = $this->__getHost();
        $paramQueryBuild = $this->_buildParam($paramQuery, $this->accessToken);
        $headerBuild     = $this->_buildHeader($header);

        $response = $this->httpBuilder
            ->setTimeout(60)
            ->host($host)
            ->header($headerBuild)
            ->queryString($paramQueryBuild)
            ->get($url)
            ->call(false, true);

        return $this->__parseResult($response);

    }

    protected function _requestPost($url = "", $paramQuery = [], $header = [])
    {
        $host            = $this->__getHost();
        $paramQueryBuild = $this->_buildParam($paramQuery, $this->accessToken);
        $headerBuild     = $this->_buildHeader($header);

        $response = $this->httpBuilder
            ->setTimeout(60)
            ->host($host)
            ->header($headerBuild)
            ->formParams($paramQueryBuild)
            ->post($url)
            ->call(false, true);

        return $this->__parseResult($response);
    }

    public abstract function process($paramQuery = []);
}

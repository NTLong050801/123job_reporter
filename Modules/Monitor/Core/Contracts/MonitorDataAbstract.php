<?php

namespace Modules\Monitor\Core\Contracts;


use Modules\Monitor\Core\Traits\MonitorRequestHttpTrait;
use Workable\Support\Http\HttpBuilder;

abstract class MonitorDataAbstract
{
    use MonitorRequestHttpTrait;

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

    public function setSourceCrawl($sourceCrawl = [])
    {
        $this->sourceCrawl = $sourceCrawl;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

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
        $host = $this->__getHost();
        $paramQueryBuild = $this->_buildParam($paramQuery, $this->accessToken);
        $headerBuild = $this->_buildHeader($header);

        return $this->httpBuilder
            ->setTimeout(60)
            ->host($host)
            ->header($headerBuild)
            ->queryString($paramQueryBuild)
            ->get($url)
            ->call(false, true);

    }

    protected function _requestPost($url = "", $paramQuery = [], $header = [])
    {
        $host = $this->__getHost();
        $paramQueryBuild = $this->_buildParam($paramQuery, $this->accessToken);
        $headerBuild = $this->_buildHeader($header);

        return $this->httpBuilder
            ->setTimeout(60)
            ->host($host)
            ->header($headerBuild)
            ->formParams($paramQueryBuild)
            ->post($url)
            ->call(false, true);

    }

    public abstract function process($item = [], $paramQuery = [], $header = []);
}

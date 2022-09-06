<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 11:09
 */

namespace Workable\Support\Http;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Workable\Base\Supports\CliEcho;
use Workable\Support\Http\Contracts\HttpRequestAbstract;

class HttpBuilder extends HttpRequestAbstract
{
    protected $requestError = false;

    /**
     * preview
     * @return array
     * User: Hungokata
     * Date: 2021/04/21 - 12:21
     */
    public function preview()
    {
        return [
            "uri"  => $this->__makeUri(),
            "data" => $this->__makeDataSent()
        ];
    }

    /**
     * makeUri
     * @return string
     * User: Hungokata
     * Date: 2021/04/21 - 12:14
     */
    private function __makeUri()
    {
        if (Str::contains($this->uri, ["http", "https"])) {
            $uri = $this->uri;
        } else {
            $uri = rtrim($this->apiUrl, "/") . "/" . ltrim($this->uri, "/");
        }
        return $uri;
    }

    /**
     * makeDataSent
     * @return array
     * User: Hungokata
     * Date: 2021/04/21 - 12:14
     */
    private function __makeDataSent()
    {
        $data = ['headers' => $this->headers];

        if (!empty($this->body)) {
            $data["json"] = $this->body;

        }
        if (!empty($this->formParams)) {
            $data["form_params"] = $this->formParams;

        }
        if (!empty($this->multipart)) {
            $data["multipart"] = $this->multipart;

        }
        if (!empty($this->queryString)) {
            $data["query"] = $this->queryString;
        }

        if ($this->timeOut !== null) {
            $data['timeout'] = $this->timeOut;
        }

        return $data;
    }

    public function validateRequest()
    {
        return $this->requestError;
    }

    public function getDataResponse($response, $defaultValue = [])
    {
        if ($this->requestError()) {
            return $defaultValue;
        } else {
            $result = $response->getBody()->getContents();
            $result = json_decode($result, true);
            return $result;
        }
    }

    public function requestError()
    {
        return $this->requestError ? 1 : 0;
    }

    private function __infoRequest($async = false, $debug = false, $dataRequest = [])
    {
        if (!$debug) return false;

        $type = ($async ? "requestAsync " : "request") ;
        CliEcho::infonl("Request ". $type . '-' . print_r($dataRequest, true));
        return true;
    }

    private function __getDataRequest($uri, $data)
    {
        $dataLog = [
            "method" => $this->method,
            "uri" => $uri,
            "data" => $data,
        ];
        return $dataLog;
    }

    public function call($async = false, $debug = false)
    {
        $this->__resetAttribute();
        $uri  = $this->__makeUri();
        $this->__debugStart($uri);

        $data        = $this->__makeDataSent();
        $dataRequest = $this->__getDataRequest($uri, $data);
        $this->__infoRequest($async, $debug, $dataRequest);

        try {
            if ($async) {
                $result = $this->httpClient->requestAsync($this->method, $uri, $data);
                $this->__debugEnd($uri);
                return $result;
            } else {
                $result = $this->httpClient->request($this->method, $uri, $data);
                $this->__debugEnd($uri);
                return $result;
            }
        } catch (ClientException|GuzzleException|ServerException $e) {
            $this->requestError = true;
            $this->__debugEnd($uri);
            $this->logException($e, $dataRequest);
            return $e;
        }
    }

    private function __resetAttribute()
    {
        $this->requestError = false;
    }

    private function logException($e, $dataRequest)
    {
        Log::warning(print_r($dataRequest, true) . get_data_exception($e));
    }

    private function __debugStart($uri)
    {
        if (in_array($this->env, ['local', 'dev']))
        {
            $uri = $uri .'-'. rand(0,10);
            try
            {
                \Debugbar::startMeasure($uri, $uri);
            }
            catch (\Exception $e) {
            }
        }
    }

    private function __debugEnd($uri)
    {
        if (in_array($this->env, ['local', 'dev'])) {
            try {
                \Debugbar::endMeasure($uri);
            } catch (\Exception $e) {

            }

        }
    }
}

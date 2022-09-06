<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 11:15
 */

namespace Workable\Support\Http\Contracts;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Workable\Support\Http\Traits\PingHttp;

abstract class HttpRequestAbstract implements HttpRequestInterface
{
    use PingHttp;

    /** @var string */
    const HTTP_GET = 'GET';

    /** @var string */
    const HTTP_POST = 'POST';

    /** @var string */
    const HTTP_PUT = 'PUT';

    /** @var string */
    const HTTP_PATCH = 'PATCH';

    /** @var string */
    const HTTP_DELETE = 'DELETE';

    /** @var string $apiUrl */
    protected $apiUrl;

    /** @var string $method */
    protected $method;

    /** @var string $uri */
    protected $uri = '/';

    /** @var array $body */
    protected $body = [];

    /** @var array $formParams */
    protected $formParams = [];

    /** @var array $multipart */
    protected $multipart = [];

    /** @var array $headers */
    protected $headers = [];

    /** @var array $queryString */
    protected $queryString = [];

    /** @var Request $request */
    protected $request;

    /** @var Client $httpClient */
    protected $httpClient;

    /**
     * @var int
     */
    protected $timeOut = 5;

    /**
     * @var $env
     */
    protected $env;

    /**
     * ApiRequestBuilder constructor.
     * @param string $url
     * @param string $uri
     * @param string $method
     */
    public function __construct(string $url = '', string $uri = "", string $method = self::HTTP_POST)
    {
        $this->apiUrl     = $url;
        $this->method     = $method;
        $this->httpClient = new Client([
            'timeout'         => $this->timeOut,
            'allow_redirects' => $this->allowRedirects,
        ]);
        $this->env        = app()->environment();
        $this->uri        = $uri;
    }

    public function setTimeout($timeOut)
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * host
     * @param $host
     * User: Hungokata
     * Date: 2021/04/21 - 12:16
     */
    public function host($host)
    {
        $this->apiUrl = $host;

        return $this;
    }

    public function get($uri)
    {
        $this->method = self::HTTP_GET;
        $this->uri    = $uri;
        return $this;
    }

    public function post($uri)
    {
        $this->method = self::HTTP_POST;
        $this->uri    = $uri;
        return $this;
    }

    public function put($uri)
    {
        $this->method = self::HTTP_PUT;
        $this->uri    = $uri;
        return $this;
    }

    public function delete($uri)
    {
        $this->method = self::HTTP_DELETE;
        $this->uri    = $uri;
        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function method(string $method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function uri(string $uri)
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function body(array $body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param array $formParams
     * @return $this
     */
    public function formParams(array $formParams)
    {
        $this->formParams = $formParams;
        return $this;
    }

    /**
     * @param array $multipart
     * @return $this
     */
    public function multipart(array $multipart)
    {
        $this->multipart = $multipart;
        return $this;
    }

    /**
     * @param array $header
     * @return $this
     */
    public function header(array $header)
    {
        $this->headers = array_merge($this->headers, $header);
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function bearerToken(string $token)
    {
        $this->headers['Authorization'] = 'Bearer ' . $token;
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function basicAuthentication(string $token)
    {
        $this->headers['Authorization'] = 'Basic ' . $token;
        return $this;
    }

    /**
     * @param array $queryString
     * @return $this
     */
    public function queryString(array $queryString)
    {
        $this->queryString = $queryString;
        return $this;
    }
}

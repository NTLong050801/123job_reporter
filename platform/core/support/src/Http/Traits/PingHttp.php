<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/18 - 10:33
 */

namespace Workable\Support\Http\Traits;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Workable\Base\Supports\CliEcho;

trait PingHttp
{
    /**
     * @var bool
     */
    protected $allowRedirects = true;

    protected $resultCheck = null;

    /**
     * Check server ready
     * @param bool $debug
     * @return int|mixed|null|\Psr\Http\Message\ResponseInterface
     * User: Hungokata
     * Date: 2021/08/24 - 10:39
     */
    public function check($debug = false)
    {
        $response         = null;
        $exceptionMessage = null;

        try {

            $method = mb_strtolower($this->method);
            switch ($method) {
                case 'get':
                    $response = $this->httpClient->get($this->uri);
                    break;

                case 'post':
                    $response = $this->httpClient->post($this->uri);
                    break;
            }
            $response = $response->getStatusCode();
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
            $response = $response->getStatusCode();
            $exceptionMessage = $e->getMessage();
        }
        catch (ConnectException $e) {
            $response = $e->getCode();
            $exceptionMessage = $e->getMessage();
        }
        catch (ServerException $e) {
            $response = $e->getCode();
            $exceptionMessage = $e->getMessage();
        }

        $this->resultCheck = [
            "payloadUrl" => $this->uri,
            "payloadMethod" => $this->method,
            'responseStatus' => $response,
            "exceptionMessage" => $exceptionMessage
        ];

        // Debug
        if ($debug)
        {
            CliEcho::infonl("-- HttpBuilder check: " . print_r($this->resultCheck, true));
        }

        return $response;
    }

    public function getResultCheck()
    {
        return $this->resultCheck;
    }
}
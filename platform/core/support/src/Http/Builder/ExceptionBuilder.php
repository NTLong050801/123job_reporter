<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 12:19
 */
namespace Workable\Support\Http\Builder;
use Workable\Support\Http\Exceptions\InformationalException;
use Workable\Support\Http\Exceptions\RedirectException;
use Workable\Support\Http\Exceptions\ServerException;
trait ExceptionBuilder
{
    /**
     * This method will help rethrowing the request exceptions
     * @param $code
     * @param $message
     * @param $stackTrace
     * @throws ClientException
     * @throws InformationalException
     * @throws RedirectException
     * @throws ServerException
     */
    protected function _checkStatusCode($code, $message = '', $stackTrace = '', $clientResponse = null)
    {
        //Status code 5**
        if ($this->isServerError($code)){
            throw new ServerException($code, $message, $stackTrace, $clientResponse);
        }

        //Status code 4**
        if ($this->isClientError($code)){
            throw new ClientException($code, $message, $stackTrace, $clientResponse);
        }

        //Status code 3**
        if ($this->isRedirect($code)){
            throw new RedirectException($code, $message, $stackTrace, $clientResponse);
        }

        //Status code 1**
        if ($this->isInformational($code)){
            throw new InformationalException($code, $message, $stackTrace, $clientResponse);
        }
    }

    /**
     * Checks if HTTP Status code is Server Error (5xx)
     * @param integer $status
     * @return bool
     */
    public function isServerError($status)
    {
        return $status >= 500 && $status < 600;
    }

    /**
     * Checks if HTTP Status code is a Client Error (4xx)
     * @param integer $status
     * @return bool
     */
    public function isClientError($status)
    {
        return $status >= 400 && $status < 500;
    }

    /**
     * Checks if HTTP Status code is a Redirect (3xx)
     * @param integer $status
     * @return bool
     */
    public function isRedirect($status)
    {
        return $status >= 300 && $status < 400;
    }

    /**
     * Checks if HTTP Status code is Information (1xx)
     * @param integer $status
     * @return bool
     */
    public function isInformational($status)
    {
        return $status < 200;
    }
}
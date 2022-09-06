<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 16/06/2021
 * Time: 5:03 PM
 */

namespace Workable\GoogleLog\Services;

use Google\Client;
use Illuminate\Support\Facades\Log;
use Workable\Base\Supports\CliEcho;

class GoogleAnalystBaseService
{
    private $config = [];

    /**
     * @var Client
     */
    private $googleClient;

    public function __construct($keyConfig = '123job')
    {
        $this->setConfig($keyConfig);
        $this->googleClient = new Client();
    }

    public function setConfig($keyConfig)
    {
        $this->config = config('packages.ga_api.' . $keyConfig);
    }

    public function getData(array $param)
    {
        if(!$this->config) return null;
        $fileConfig = $this->config['file_config'];


        $this->googleClient->setAuthConfig($fileConfig);
        $this->googleClient->addScope(\Google_Service_Analytics::ANALYTICS_READONLY);

        $webmastersService = new \Google_Service_Analytics($this->googleClient);

        $dataAnalytics = null;
        try
        {
            $dataAnalytics = $webmastersService
                ->data_ga
                ->get($this->config['ga_id'], $param['start_date'], $param['end_date'], $param['metric'], $param['option']);
        }
        catch (\Exception $e)
        {
            Log::warning(get_data_exception($e));
        }

        return $dataAnalytics;
    }
}
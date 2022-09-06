<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/01/18 - 15:31
 */
namespace Workable\BinderProxy;

class BinderService
{
    public static $cache = false;
    public static $cache_driver;
    public static $cache_time = 600; // default 10 minutes
    public static $mode = 'local';

    public $binder;
    public $results = []; // cache call result

    protected static $client;

    public static $modes_configuration = [
        'local' => null,
        'remote' => [
            'host' => 'http://123job.vn',
            'key' => '',
        ]
    ];

    protected $tmp_local_cache_default_value = null;
    protected $tmp_local_cache_mode = 'default';

    /**
     * BinderService constructor.
     */
    public function __construct($binder)
    {
        if (self::$mode !== 'local') {
            $this->binder = $binder;
        } else {
            $this->binder = new $binder;
        }
    }

    /**
     * Call static
     * @param $name
     * @param $arguments
     * @return null
     * User: Hungokata
     * Date: 2021/01/18 - 14:19
     */
    public function __call($name, $arguments)
    {
        switch (self::$mode)
        {
            case 'api':

                break;

            default:
                $key = self::__makeKey($this->binder, $name, $arguments, "cached_function:");

                if (!empty($this->results[$key])) {
                    return $this->results[$key];
                }
                $result = $this->__callLocal($key, $name, $arguments);
                break;
        }

        return $result;
    }

    /**
     * Make key cache
     * User: Hungokata
     * Date: 2021/01/18 - 14:19
     */
    private static function __makeKey($binder, $method, $arguments = [], $prefix = 'rpc:')
    {
        $binder = is_object($binder) ? get_class($binder) : $binder;
        return $prefix . md5($binder . $method . json_encode($arguments));
    }

    /**
     * Call api
     * @return null
     * User: Hungokata
     * Date: 2021/01/18 - 14:19
     */
    private function callApi()
    {
        return null;
    }

    private function __getLocalCacheConfig($binder, $method, $arguments)
    {
        $binder               = is_object($binder) ? get_class($binder) : $binder;
        $binder_cache_config  = $binder::$cache_config ?? [];
        $requesting_arguments = json_encode($arguments);

        foreach ($binder_cache_config as $function_config)
        {
            if ($function_config['function'] == $method && $requesting_arguments == json_encode($function_config['arguments']))
            {
                return $function_config;
            }
        }

        return [];
    }

    /**
     * Call local
     * @return null
     * User: Hungokata
     * Date: 2021/01/18 - 14:19
     */
    private function __callLocal($key, $name, $arguments = [])
    {
        $local_cache_config = $this->__getLocalCacheConfig($this->binder, $name, $arguments);
        if (count($local_cache_config) == 0)
        {
            $result = call_user_func_array([$this->binder, $name], $arguments);
        }
        else
        {
            switch ($this->tmp_local_cache_mode)
            {
                case "no_cache":
                    $result = call_user_func_array([$this->binder, $name], $arguments);
                    \Cache::put($key, $result, $local_cache_config['timeout']);
                    break;

                case "cache_only":
                    $result = \Cache::get($key, $this->tmp_local_cache_default_value);
                    break;

                default:
                    $result = \Cache::remember($key, $local_cache_config['timeout'], function () use ($name, $arguments)
                    {
                        return call_user_func_array([$this->binder, $name], $arguments);
                    });
            }
        }

        $this->results[$key] = $result;
        return $result;
    }

    public function __destruct()
    {
        // Always reset local cache options
        $this->tmp_local_cache_default_value = null;
        $this->tmp_local_cache_mode = "default";
    }
}

<?php


namespace Workable\PackageGenerator\Support;


use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PackageSupport
{
    protected static $config;
    protected static $instance;

    /**
     * PackageSupport constructor.
     * @param null $config
     */
    public function __construct($config = null)
    {
        if (!$config) {
            self::$config = config("packages.package-generator.package-generator");
        }
    }

    /**
     * @return PackageSupport
     */
    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($key)
    {
        return Arr::get(self::$config, $key);
    }

    /**
     * @return mixed|string
     */
    public static function getNameSpace()
    {
        self::instance();
        return self::$config['package_namespace'] ?? "Workable";
    }

    /**
     * @return mixed|string
     */
    public static function getPlatform()
    {
        self::instance();
        return self::$config['package_platform'] ?? "packages";
    }

    /**
     * @return mixed|string
     */
    public static function getPackage()
    {
        self::instance();
        return self::$config['package_work'] ?? "package";
    }

    /**
     * @return array|mixed
     */
    public static function generator()
    {
        self::instance();
        return self::$config['generator'] ?? [];
    }
}

<?php

class MobileDetectSingleton
{
    protected static $instance = null;
    public static function instance()
    {
        if (self::$instance === null)
        {
            self::$instance = new \Detection\MobileDetect();
        }
        return self::$instance;
    }
}

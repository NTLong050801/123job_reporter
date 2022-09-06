<?php

if (!function_exists('detect_device'))
{
    function detect_device()
    {
        $instance = \MobileDetectSingleton::instance();
        return $instance;
    }
}

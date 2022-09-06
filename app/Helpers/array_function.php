<?php

if (!function_exists("array_get"))
{
    function array_get($array, $key, $defaultValue = '')
    {
        return \Illuminate\Support\Arr::get($array, $key, $defaultValue);
    }
}

if (!function_exists('get_data_php'))
{
    function get_data_php($path, $key = '')
    {
        $path = str_replace('.', '/', $path);
        $path .= '.php';
        $data = require database_path($path);
        if ($key)
        {
            return $data[$key] ?? null;
        }

        return $data;
    }
}
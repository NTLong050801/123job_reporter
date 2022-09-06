<?php

if (!function_exists('get_data_user'))
{
    function get_data_user($type, $field = 'id')
    {
        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : '';
    }
}


if (!function_exists('param_get'))
{
    /**
     * If the given value is not an array, wrap it in one.
     *
     * @param mixed $params
     * @param string $key
     * @param null $default
     *
     * @return array
     *
     */
    function param_get(array $params, string $key, $default = null)
    {
        return $params[$key] ?? $default;
    }
}


if (!function_exists('get_url'))
{
    function get_url($host, $url)
    {
        $link = config('settings.url.'.$host);
        $link = rtrim($link, '/');
        $link .= '/'.ltrim($url, '/');

        return $link;
    }
}

if (!function_exists('make_queue_name'))
{
    function make_queue_name(string $name): string
    {
        $env = app()->environment();
        if (!in_array($env, ['production', 'prod']))
        {
            $name = $env . '-' . $name;
        }
        return $name;
    }
}

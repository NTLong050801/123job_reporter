<?php
if (!function_exists('access_bot')) {
    function access_bot()
    {
        return detect_device()->isBot();
    }
}

if (!function_exists('not_bot')) {
    function not_bot()
    {
        return !detect_device()->isBot();
    }
}

if (!function_exists('ip_user_client')) {
    function ip_user_client()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}

if (!function_exists('remove_http'))
{
    function remove_http($url = "")
    {
        $url = trim($url, '/');
        // If scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $url)) $url = 'http://' . $url;

        $urlParts = parse_url($url);

        // remove www
        $domain = preg_replace('/^www\./', '', $urlParts['host']);
        return $domain . $urlParts['path'];
    }
}

if (!function_exists('get_host_url'))
{
    function get_host_url($url)
    {
        $parseUrl = parse_url(trim($url));
        if(isset($parseUrl['host']))
        {
            $host = $parseUrl['host'];
        }
        else
        {
            $path = explode('/', $parseUrl['path']);
            $host = $path[0];
        }

        // remove www
        $host = preg_replace('/^www\./', '', $host);
        return trim($host);
    }
}
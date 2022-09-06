<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 1/23/18
 * Time: 10:22 AM
 */

class UrlHelper
{
    public static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Hàm build url
     * @param array $params
     * @param null $url
     * @return string
     * Cách sử dụng: UrlHelper::addParams(['filter', 1])
     */
    public static function addParams(array $params = array(), $url = null)
    {
        if (is_null($url)) {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        $parseUrl = parse_url($url);
        $query = isset($parseUrl['query']) ? $parseUrl['query'] : "";
        if ($query) {
            parse_str($query, $parseQuery);
            $params = array_merge($parseQuery, $params);
        }

        ksort($params);
        $urlReturn = [
            isset($parseUrl['scheme']) ? $parseUrl['scheme'] : 'http',
            '://',
            $parseUrl['host'],
            isset($parseUrl['path']) ? $parseUrl['path'] : '',
            '?',
            urldecode(http_build_query($params))
        ];

        return implode('', $urlReturn);
    }

    public static function removeParam($keys ='', $url='')
    {
        $string = null;
        if (!$url)
        {
            $url    = self::getRequestUrl();
        }
        $parsed = parse_url($url);
        if (isset($parsed['query']) && $parsed['query'])
        {
            parse_str($parsed['query'], $params);
            $keys = (array)$keys;
            foreach ($keys as $key)
            {
                unset($params[$key]);
            }
            $string = urldecode(http_build_query($params));
        }

        $url = $parsed['scheme'].'://'.$parsed['host'].$parsed['path'];

        if ($string) $url .= '?'.$string;

        return $url;
    }

    public static function getRequestUrl($full = true)
    {
        return $full ? \Request::fullUrl() : \Request::url();
    }

    public static function getParamRequestUri($params = [], $url = null)
    {
        if (is_null($url)) {
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }
        $parseUrl = parse_url($url);
        $query = isset($parseUrl['query']) ? $parseUrl['query'] : "";
        if ($query) {
            parse_str($query, $parseQuery);
            $params = array_merge($parseQuery, $params);
        }

        ksort($params);
        return $params;
    }
}
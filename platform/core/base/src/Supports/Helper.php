<?php

namespace Workable\Base\Supports;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Helper
{
    public static function autoload($directory)
    {
        $helpers = File::glob($directory . '/*.php');
        foreach ($helpers as $helper) {
            require_once($helper);
        }
    }

//    public static function handleViewCount(Eloquent $object, $session_name)
//    {
//        $blank_array = [];
//        if (!array_key_exists($object->id, session()->get($session_name, $blank_array))) {
//            try {
//                $object->increment('views');
//                session()->put($session_name . '.' . $object->id, time());
//                return true;
//            } catch (Exception $ex) {
//                return false;
//            }
//        }
//
//        return false;
//    }
//
//    public static function formatLog($input, $line = '', $function = '', $class = '')
//    {
//        return array_merge($input, [
//            'user_id' => Auth::check() ? Auth::user()->getKey() : 'System',
//            'ip' => Request::ip(),
//            'line' => $line,
//            'function' => $function,
//            'class' => $class,
//            'userAgent' => Request::header('User-Agent'),
//        ]);
//    }
}

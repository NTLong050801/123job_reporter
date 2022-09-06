<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 12:05
 */

namespace Workable\Support\Http;


use Illuminate\Support\Facades\Facade;

class HttpFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return "http-builder";
    }
}

<?php

namespace Workable\GoogleLog\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "google-log";
    }
}

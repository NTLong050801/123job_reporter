<?php

namespace Workable\SubscribeJob\Facades;

use Illuminate\Support\Facades\Facade;

class SubscribeJob extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "subscribe-job";
    }
}

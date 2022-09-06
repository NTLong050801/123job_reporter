<?php

namespace Workable\organization\Facades;

use Illuminate\Support\Facades\Facade;

class organization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "organization";
    }
}

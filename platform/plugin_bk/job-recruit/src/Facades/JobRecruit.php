<?php

namespace Workable\JobRecruit\Facades;

use Illuminate\Support\Facades\Facade;

class JobRecruit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "job-recruit";
    }
}

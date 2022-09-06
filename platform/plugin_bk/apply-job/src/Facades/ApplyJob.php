<?php

namespace Workable\ApplyJob\Facades;

use Illuminate\Support\Facades\Facade;

class ApplyJob extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "apply-job";
    }
}

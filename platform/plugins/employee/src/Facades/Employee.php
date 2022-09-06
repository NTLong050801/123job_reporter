<?php

namespace Workable\Employee\Facades;

use Illuminate\Support\Facades\Facade;

class Employee extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "employee";
    }
}

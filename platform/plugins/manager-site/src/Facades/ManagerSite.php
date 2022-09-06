<?php

namespace Workable\ManagerSite\Facades;

use Illuminate\Support\Facades\Facade;

class ManagerSite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "manager-site";
    }
}

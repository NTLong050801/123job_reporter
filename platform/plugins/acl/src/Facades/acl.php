<?php

namespace Workable\Acl\Facades;

use Illuminate\Support\Facades\Facade;

class acl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "acl";
    }
}

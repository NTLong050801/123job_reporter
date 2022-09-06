<?php

namespace Workable\System\Facades;

use Illuminate\Support\Facades\Facade;

class System extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "system";
    }
}

<?php

namespace Workable\Attribute\Facades;

use Illuminate\Support\Facades\Facade;

class Attribute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "attribute";
    }
}

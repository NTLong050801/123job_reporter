<?php

namespace Workable\ReferenceSite\Facades;

use Illuminate\Support\Facades\Facade;

class ReferenceSite extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "reference-site";
    }
}

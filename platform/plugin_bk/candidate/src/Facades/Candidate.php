<?php

namespace Workable\Candidate\Facades;

use Illuminate\Support\Facades\Facade;

class Candidate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "candidate";
    }
}

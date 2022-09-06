<?php

namespace Workable\RobotLog\Facades;

use Illuminate\Support\Facades\Facade;

class RobotLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "robot-log";
    }
}

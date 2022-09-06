<?php

namespace Workable\AuditLog\Facades;

use Illuminate\Support\Facades\Facade;

class AuditLogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Workable\AuditLog\AuditLog::class;
    }
}

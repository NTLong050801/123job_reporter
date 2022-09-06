<?php

namespace Workable\AuditLog\Tests;

use Workable\AuditLog\Facades\AuditLogFacade;
use Workable\AuditLog\AuditLogServiceProvider;

use PHPUnit\Framework\TestCase;

class AuditLogTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AuditLogServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'audit-log' => AuditLogFacade::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

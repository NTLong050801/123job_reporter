<?php

namespace Workable\Employee\Tests;

use Workable\Employee\Facades\Employee;
use Workable\Employee\EmployeeServiceProvider;

use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [EmployeeServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'employee' => Employee::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

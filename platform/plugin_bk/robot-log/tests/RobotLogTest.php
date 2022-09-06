<?php

namespace Workable\RobotLog\Tests;

use Workable\RobotLog\Facades\RobotLog;
use Workable\RobotLog\RobotLogServiceProvider;

use PHPUnit\Framework\TestCase;

class RobotLogTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [RobotLogServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'robot-log' => RobotLog::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

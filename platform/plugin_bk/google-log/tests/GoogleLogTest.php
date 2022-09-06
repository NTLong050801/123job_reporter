<?php

namespace Workable\GoogleLog\Tests;

use Workable\GoogleLog\Facades\GoogleLog;
use Workable\GoogleLog\GoogleLogServiceProvider;

use PHPUnit\Framework\TestCase;

class GoogleLogTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [GoogleLogServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'google-log' => GoogleLog::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

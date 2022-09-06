<?php

namespace Workable\System\Tests;

use Workable\System\Facades\System;
use Workable\System\SystemServiceProvider;

use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [SystemServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'system' => System::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

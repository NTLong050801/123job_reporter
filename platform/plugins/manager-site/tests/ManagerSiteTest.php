<?php

namespace Workable\ManagerSite\Tests;

use Workable\ManagerSite\Facades\ManagerSite;
use Workable\ManagerSite\ManagerSiteServiceProvider;

use PHPUnit\Framework\TestCase;

class ManagerSiteTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ManagerSiteServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'manager-site' => ManagerSite::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

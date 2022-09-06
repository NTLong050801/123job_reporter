<?php

namespace Workable\organization\Tests;

use Workable\organization\Facades\organization;
use Workable\organization\organizationServiceProvider;

use PHPUnit\Framework\TestCase;

class organizationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [organizationServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'organization' => organization::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

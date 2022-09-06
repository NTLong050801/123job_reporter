<?php

namespace Workable\acl\Tests;

use Workable\acl\Facades\acl;
use Workable\acl\aclServiceProvider;

use PHPUnit\Framework\TestCase;

class aclTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [aclServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'acl' => acl::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

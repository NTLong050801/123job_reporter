<?php

namespace Workable\ReferenceSite\Tests;

use Workable\ReferenceSite\Facades\ReferenceSite;
use Workable\ReferenceSite\ReferenceSiteServiceProvider;

use PHPUnit\Framework\TestCase;

class ReferenceSiteTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ReferenceSiteServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'reference-site' => ReferenceSite::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

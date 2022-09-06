<?php

namespace Workable\SubscribeJob\Tests;

use Workable\SubscribeJob\Facades\SubscribeJob;
use Workable\SubscribeJob\SubscribeJobServiceProvider;

use PHPUnit\Framework\TestCase;

class SubscribeJobTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [SubscribeJobServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'subscribe-job' => SubscribeJob::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

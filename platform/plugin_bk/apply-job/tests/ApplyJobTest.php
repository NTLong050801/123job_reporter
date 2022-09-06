<?php

namespace Workable\ApplyJob\Tests;

use Workable\ApplyJob\Facades\ApplyJob;
use Workable\ApplyJob\ApplyJobServiceProvider;

use PHPUnit\Framework\TestCase;

class ApplyJobTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ApplyJobServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'apply-job' => ApplyJob::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

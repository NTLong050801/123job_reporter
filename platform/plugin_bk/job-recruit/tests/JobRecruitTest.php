<?php

namespace Workable\JobRecruit\Tests;

use Workable\JobRecruit\Facades\JobRecruit;
use Workable\JobRecruit\JobRecruitServiceProvider;

use PHPUnit\Framework\TestCase;

class JobRecruitTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [JobRecruitServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'job-recruit' => JobRecruit::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

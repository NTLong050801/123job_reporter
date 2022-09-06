<?php

namespace Workable\Candidate\Tests;

use Workable\Candidate\Facades\Candidate;
use Workable\Candidate\CandidateServiceProvider;

use PHPUnit\Framework\TestCase;

class CandidateTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [CandidateServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'candidate' => Candidate::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

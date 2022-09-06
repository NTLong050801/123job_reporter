<?php

namespace Workable\Attribute\Tests;

use Workable\Attribute\Facades\Attribute;
use Workable\Attribute\AttributeServiceProvider;

use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AttributeServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'attribute' => Attribute::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

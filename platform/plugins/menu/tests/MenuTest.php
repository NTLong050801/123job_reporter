<?php

namespace Workable\Menu\Tests;

use Workable\Menu\Facades\Menu;
use Workable\Menu\MenuServiceProvider;

use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [MenuServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'menu' => Menu::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}

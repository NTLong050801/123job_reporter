<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 9/6/19
 * Time: 20:22
 */

namespace Workable\Support\Providers;


use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;

class SupportServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(HttpServiceProvider::class);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/04/21 - 11:53
 */
namespace Workable\Support\Providers;
use Illuminate\Foundation\AliasLoader;
use Workable\Support\Http\HttpBuilder;
use Workable\Support\Http\HttpFacade;

class HttpServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind("http-builder", function () {
            return new HttpBuilder();
        });
        AliasLoader::getInstance()->alias('HttpBuilder', HttpFacade::class);
    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

    }
}
<?php

namespace Workable\Setting;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;

use Workable\Setting\Supports\SettingManager;
use Workable\Setting\Supports\SettingStore;

class SettingServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(SettingManager::class, function (Application $app) {
            return new SettingManager($app);
        });

        $this->app->bind(SettingStore::class, function (Application $app) {
            return $app->make(SettingManager::class)->driver();
        });

        AliasLoader::getInstance()->alias('Setting', SettingFacade::class);
        Helper::autoload(__DIR__.'/../helper');
    }

    public function boot()
    {
//        $this->loadRoutes()
//            ->loadMigrations()
//            ->loadAndPublishViews();
    }
}

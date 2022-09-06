<?php

namespace Modules\Monitor\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Monitor\Console\WorkerCrawMonitorCommand;

class MonitorServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerCommand();
        $this->loadMigrationsFrom(module_path('Monitor', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Monitor', 'Config/config.php') => config_path('monitor.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Monitor', 'Config/config.php'), 'monitor'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/monitor');

        $sourcePath = module_path('Monitor', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/monitor';
        }, \Config::get('view.paths')), [$sourcePath]), 'monitor');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/monitor');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'monitor');
        } else {
            $this->loadTranslationsFrom(module_path('Monitor', 'Resources/lang'), 'monitor');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Monitor', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
    private function registerCommand()
    {
        $this->commands([
            WorkerCrawMonitorCommand::class,
        ]);
    }

}

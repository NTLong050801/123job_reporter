<?php

namespace Modules\Collect\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Modules\Collect\Console\Commands\Crawl\WorkerCrawlReferenceCommand;
use Modules\Collect\Console\Commands\Crawl\WorkerCrawlRobotCommand;
use Modules\Collect\Console\Commands\Crawl\WorkerCrawlSeoContentCommand;
use Modules\Collect\Console\Commands\Crawl\WorkerCrawlDataSourceCommand;

class CollectServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerFactories();
        $this->registerCommand();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Collect', 'Config/config.php') => config_path('collect.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Collect', 'Config/config.php'), 'collect'
        );
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Collect', 'Database/factories'));
        }
    }

    private function registerCommand()
    {
        $this->commands([
            WorkerCrawlDataSourceCommand::class,
        ]);
    }
}

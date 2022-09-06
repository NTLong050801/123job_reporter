<?php
namespace Workable\SubscribeJob;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\SubscribeJob\Console\SubscribeJobApiCommand;
use Workable\SubscribeJob\Console\SubscribeJobReportCommand;


class SubscribeJobServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/subscribe-job')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadAndPublishViews()
            ->loadMigrations()
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api']);

        $this->commands([
            SubscribeJobReportCommand::class,
            SubscribeJobApiCommand::class
        ]);
    }


    public function register()
    {
        $this->app->bind('subscribe-job', function () {
            return new SubscribeJob();
        });
    }
}

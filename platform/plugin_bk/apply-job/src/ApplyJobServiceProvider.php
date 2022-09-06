<?php

namespace Workable\ApplyJob;

use Illuminate\Support\ServiceProvider;
use Workable\ApplyJob\Console\ApplyJobReportCommand;
use Workable\ApplyJob\Console\ApplyReportApiCommand;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class ApplyJobServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/apply-job')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews();

        $this->commands([
            ApplyJobReportCommand::class,
            ApplyReportApiCommand::class
        ]);
    }

    public function registerRepository()
    {

    }

    public function register()
    {
        $this->registerRepository();
        $this->app->bind('apply-job', function () {
            return new ApplyJob();
        });
    }
}

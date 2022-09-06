<?php
namespace Workable\ReferenceSite;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\ReferenceSite\Console\JobReferReportApiCommand;
use Workable\ReferenceSite\Console\JobReferReportCommand;


class ReferenceSiteServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/reference-site')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadAndPublishViews()
            ->loadBreadcrumb()
            ->loadMigrations()
            ->loadRoutes(['web', 'api']);

        $this->commands([
            JobReferReportCommand::class,
            JobReferReportApiCommand::class
        ]);

    }
}

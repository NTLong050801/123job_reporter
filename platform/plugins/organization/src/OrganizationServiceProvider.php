<?php

namespace Workable\Organization;

use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class OrganizationServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/organization')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api']);
    }

    public function registerRepository()
    {
        $models = [
            "Company",
            "Department",
            "Announcement",
            "Product"
        ];
        $namespace = "Workable\\Organization\\Repository\\";
        foreach ($models as $model) {
            $this->app->singleton(
                $namespace . $model . "\\" . $model . 'RepositoryInterface',
                $namespace . $model . "\\" . $model . 'Repository'
            );
        }
    }

    public function register()
    {
        $this->registerRepository();
        $this->app->bind('organization', function () {
            return new organization();
        });
    }
}

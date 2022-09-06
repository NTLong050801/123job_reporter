<?php

namespace Workable\Employee;

use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class EmployeeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/employee')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api']);
    }

    public function registerRepository()
    {
        $models             = [
            'Employee',
            'RoleUser'
        ];
        $namespace = "Workable\\Employee\\Repository\\";
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
        $this->app->bind('employee', function () {
            return new Employee();
        });
    }
}

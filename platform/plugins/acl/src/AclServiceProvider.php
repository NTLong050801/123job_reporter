<?php

namespace Workable\Acl;

use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Auth;
use Illuminate\Support\Facades\Blade;
use Workable\Acl\Enum\RoleEnum;

class AclServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/acl')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api']);
        $this->registerRepository();
    }

    public function registerRepository()
    {
        $models             = [
            "Role",
            "Permission"
        ];
        $namespace = "Workable\\Acl\\Repository\\";
        foreach ($models as $model) {
            $this->app->singleton(
                $namespace . $model . "\\" . $model . 'RepositoryInterface',
                $namespace . $model . "\\" . $model . 'Repository'
            );
        }
    }



    public function register()
    {
    }
}

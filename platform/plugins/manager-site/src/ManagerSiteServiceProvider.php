<?php
namespace Workable\ManagerSite;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class ManagerSiteServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/manager-site')
          ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadBreadcrumb()
          ->loadRoutes(['web', 'api']);
    }

    public function registerRepository()
    {
         $models             = [
            "NameModel"
        ];
        $namespace = "Workable\\ManagerSite\\Repository\\";
        foreach ($models as $model)
        {
            $this->app->singleton(
                $namespace .$model . "\\" . $model . 'RepositoryInterface',
                $namespace .$model . "\\" . $model . 'Repository'
            );
        }
    }

    public function register()
    {
        $this->registerRepository();
        $this->app->bind('manager-site', function () {
            return new ManagerSite();
        });
    }
}

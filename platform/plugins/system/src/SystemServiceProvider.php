<?php
namespace Workable\System;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class SystemServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/system')
            ->loadAndPublishConfigurations(['config', 'api', 'logviewer'])
            ->loadAndPublishViews()
            ->loadRoutes(['web', 'api']);
    }

    public function registerRepository()
    {
         $models             = [
            "NameModel"
        ];
        $namespace = "Workable\\System\\Repository\\";
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
        $this->app->bind('system', function () {
            return new System();
        });
    }
}

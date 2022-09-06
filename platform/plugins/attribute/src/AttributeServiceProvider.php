<?php
namespace Workable\Attribute;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class AttributeServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/attribute')
          ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadRoutes(['web', 'api']);
    }

    public function register()
    {
        $models             = [
            "Attribute"
        ];
        $namespace = "Workable\\Attribute\\Repository\\";
        foreach ($models as $model)
        {
            $this->app->singleton(
                $namespace . $model . 'RepositoryInterface',
                $namespace . $model . 'Repository'
            );
        }

        $this->app->bind('attribute', function () {
            return new Attribute();
        });
    }
}

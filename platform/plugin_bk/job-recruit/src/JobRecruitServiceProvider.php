<?php
namespace Workable\JobRecruit;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class JobRecruitServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/job-recruit')
          ->loadAndPublishConfigurations(['config', 'api'])
          ->loadRoutes(['web', 'api']);
    }

    public function registerRepository()
    {
         $models             = [
            "NameModel"
        ];
        $namespace = "Workable\\JobRecruit\\Repository\\";
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
        $this->app->bind('job-recruit', function () {
            return new JobRecruit();
        });
    }
}

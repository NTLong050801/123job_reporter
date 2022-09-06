<?php
namespace Workable\GoogleLog;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\GoogleLog\Console\GAGetDataEventCommand;
use Workable\GoogleLog\Console\GAGetDataUserCommand;

class GoogleLogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    protected $command = [
        GAGetDataUserCommand::class,
        GAGetDataEventCommand::class
    ];

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/google-log')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadAndPublishViews()
            ->loadMigrations()
            ->loadBreadcrumb()
             ->loadRoutes(['web', 'api']);

        $this->commands($this->command);
    }

    public function registerRepository()
    {
         $models             = [
            "NameModel"
        ];
        $namespace = "Workable\\GoogleLog\\Repository\\";
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
        // $this->registerRepository();
        $this->app->bind('google-log', function () {
            return new GoogleLog();
        });
    }
}

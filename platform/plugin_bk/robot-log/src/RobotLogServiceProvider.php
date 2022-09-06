<?php
namespace Workable\RobotLog;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\RobotLog\Console\RobotCounterVisitCommand;

class RobotLogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/robot-log')
                ->loadAndPublishConfigurations(['config', 'api', 'robot_counter'])
                ->loadAndPublishViews()
                ->loadMigrations()
                ->loadBreadcrumb()
                ->loadRoutes(['web', 'api']);

        $this->commands([
            RobotCounterVisitCommand::class
        ]);
    }

    public function registerRepository()
    {
         $models             = [
            "NameModel"
        ];
        $namespace = "Workable\\RobotLog\\Repository\\";
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
        $this->app->bind('robot-log', function () {
            return new RobotLog();
        });
    }
}

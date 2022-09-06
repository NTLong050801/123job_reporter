<?php

namespace Workable\Candidate;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\Candidate\Console\Once\AddCareerTextConsole;
use Workable\Candidate\Console\Once\CleanStatisticConsole;
use Workable\Candidate\Console\Once\UpdateIntAndTextStatisticConsole;
use Workable\Candidate\Console\StatisticCandidateConsole;


class CandidateServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        Helper::autoload(__DIR__ . '/../helper');
        $this->setNamespace('plugins/candidate')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadAndPublishViews()
            ->loadMigrations()
            ->loadBreadcrumb()
            ->loadRoutes(['web', 'api']);
        $this->loadCommand();
        $this->registerSchedule();
    }

    private function loadCommand()
    {
        $this->commands([
            StatisticCandidateConsole::class,
        ]);
    }

    public function registerRepository()
    {
        $models    = [
            "Candidate",
            "CVReport",
            "CareerReport",
            "DegreeReport",
            "RankReport",
            "Career"
        ];
        $namespace = "Workable\\Candidate\\Repository\\";
        foreach ($models as $model)
        {
            $this->app->singleton(
                $namespace . $model . "\\" . $model . 'RepositoryInterface',
                $namespace . $model . "\\" . $model . 'Repository'
            );
        }
    }

    public function register()
    {
        $this->registerRepository();
        $this->app->bind('candidate', function ()
        {
            return new Candidate();
        });
    }

    public function registerSchedule()
    {
//        $this->callAfterResolving(Schedule::class, function (Schedule $schedule)
//        {
//            $schedule->command('candidate:statistic-candidate --type=cv --today')->everyTenMinutes()->withoutOverlapping();
//            $schedule->command('candidate:statistic-candidate --type=career --today')->hourly();
//            $schedule->command('candidate:statistic-candidate --type=rank --today')->hourly();
//            $schedule->command('candidate:statistic-candidate --type=degree --today')->hourly();
//        });
    }
}

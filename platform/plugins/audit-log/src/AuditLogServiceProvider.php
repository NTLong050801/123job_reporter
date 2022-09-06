<?php

namespace Workable\AuditLog;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Workable\AuditLog\Facades\AuditLogFacade;
use Workable\Base\Supports\Helper;
use Workable\Base\Traits\LoadAndPublishDataTrait;


class AuditLogServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot()
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);

        $this->setNamespace('plugins/audit-log')
            ->loadAndPublishConfigurations(['config', 'api'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadRoutes(['web', 'api']);
    }
    public function registerRepository()
    {
        $models             = [
            "Activity",
            "HistoryLogin"
        ];
        $namespace = "Workable\\AuditLog\\Repository\\";
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
        AliasLoader::getInstance()->alias('AuditLog', AuditLogFacade::class);
        Helper::autoload(__DIR__ . '/../helper');
    }
}

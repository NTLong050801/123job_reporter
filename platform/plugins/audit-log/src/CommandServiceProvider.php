<?php


namespace Workable\AuditLog;


use Illuminate\Support\ServiceProvider;
use Workable\AuditLog\Commands\ActivityLogClearCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->commands([
                ActivityLogClearCommand::class
            ]);
        }
    }
}

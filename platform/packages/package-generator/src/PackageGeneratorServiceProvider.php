<?php
namespace Workable\PackageGenerator;

use Illuminate\Support\ServiceProvider;
use Workable\Base\Traits\LoadAndPublishDataTrait;
use Workable\PackageGenerator\Command\Generators\ConsoleMakeCommand;
use Workable\PackageGenerator\Command\Generators\ControllerMakeCommand;
use Workable\PackageGenerator\Command\Generators\CurdMakeCommand;
use Workable\PackageGenerator\Command\Generators\EnumMakeCommand;
use Workable\PackageGenerator\Command\Generators\MiddlewareMakeCommand;
use Workable\PackageGenerator\Command\Generators\MigrationMakeCommand;
use Workable\PackageGenerator\Command\Generators\ModelMakeCommand;
use Workable\PackageGenerator\Command\Generators\RepositoryMakeCommand;
use Workable\PackageGenerator\Command\Generators\RequestCommand;
use Workable\PackageGenerator\Command\Generators\RouteMakeCommand;
use Workable\PackageGenerator\Command\Generators\SeedMakeCommand;
use Workable\PackageGenerator\Command\Generators\ServiceMakeCommand;
use Workable\PackageGenerator\Command\Generators\ViewMakeCommand;
use Workable\PackageGenerator\Command\PackageNewCommand;
use Workable\PackageGenerator\Command\PackageRemoveCommand;

class PackageGeneratorServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;
    public function boot()
    {
        $this->setNamespace('packages/package-generator')
            ->loadAndPublishConfigurations(['generator', 'package-generator']);
    }

    public function register()
    {
        if (app()->environment() == 'local')
        {
            $this->registerCommand();
        }
    }

    protected function registerCommand()
    {
        $this->commands([
            PackageNewCommand::class,
            PackageRemoveCommand::class,
            MigrationMakeCommand::class,
            ControllerMakeCommand::class,
            MiddlewareMakeCommand::class,
            ConsoleMakeCommand::class,
            ModelMakeCommand::class,
            SeedMakeCommand::class,
            RequestCommand::class,
            ServiceMakeCommand::class,
            RepositoryMakeCommand::class,
            RouteMakeCommand::class,
            EnumMakeCommand::class,
            ViewMakeCommand::class,
            CurdMakeCommand::class
        ]);
    }
}

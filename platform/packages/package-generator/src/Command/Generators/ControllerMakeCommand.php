<?php
namespace Workable\PackageGenerator\Command\Generators;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;

class ControllerMakeCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package-make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller';

    protected $belongTo = [
        "request", "service", "enum"
    ];

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    /**
     * Alias for the fire method.
     *
     * In Laravel 5.5 the fire() method has been renamed to handle().
     * This alias provides support for both Laravel 5.4 and 5.5.
     */
    public function handle()
    {
        $this->setNames();
        $this->setMetaObject();
        $this->fire();
    }

    public function fire()
    {
        $name           = $this->argument("name");
        $platform       = $this->option('platform');
        $package        = $this->option('package');

        $path = $this->getPath($name, $platform, $package);
        if ($this->files->exists($path))
        {
            $this->error('Controller already exists!');
            return;
        }
        $this->files->put($path, $this->compileStub());

        $this->info("Create controller:" . $path);

        $this->composer->dumpAutoloads();
    }

    private function compileStub()
    {
        return $stub = $this->option('api') ? $this->compileApiControllerStub() : $this->compileWebControllerStub();

    }

    private function compileApiControllerStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Http/Controllers/ApiController.stub");
        $stub = $this->replaceNamespace($stub)
            ->replaceNameController($stub)
            ->replaceObject($stub);

        return $stub;
    }

    /**
     * Compile the controller web stub.
     *
     * @return string
     * @throws
     */
    private function compileWebControllerStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Http/Controllers/Controller.stub");
        $this->replaceNamespace($stub)
            ->replaceNameController($stub)
            ->replaceObject($stub);

        return $stub;
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param  string $name
     * @return string
     */
    private function getPath($name, $platform, $package)
    {
        if (strpos($name, 'Controller') === false){
            $name = $name . 'Controller';
        }
        $base_path = platform_path($platform.'/'. $package);
        $api = $this->option('api') ? 'Api/' : '';
        return $base_path . "/src/Http/Controllers/{$api}" . $name . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration'],
        ];
    }

}



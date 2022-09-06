<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;

class RouteMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:route';
    protected $description = "Create route group action";

    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    public function handle()
    {
        $this->setNames();
        $this->fire();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function fire()
    {
        $name = $this->argument("name");
        $platform = $this->option('platform');
        $package = $this->option('package');
        $path = $this->getPath($name, $platform, $package);

        $stub = $this->compileStub($name);
        $this->info('-- Add below code into:' . $path);
        $this->warn($stub);
    }

    /**
     * @param $name
     * @param $platform
     * @param $package
     * @return string
     */
    public function getPath($name, $platform, $package)
    {
        $base_path = platform_path($platform . '/' . $package);
        $name = $this->option('api') ? 'api' : 'web';
        return $base_path . "/routes/" . $name . '.php';
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compileStub($name): string
    {
        return $stub = $this->option('api') ? $this->compileApiStub($name) : $this->compileWebStub($name);
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compileApiStub($name)
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Route/api.stub");
        $this->replaceNamespace($stub)
            ->replaceNameRoute($stub);

        return $stub;
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compileWebStub($name)
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Route/web.stub");
        $this->replaceNamespace($stub)
            ->replaceNameRoute($stub);

        return $stub;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The names of object will be created.'],
        ];
    }
}

<?php
namespace Workable\PackageGenerator\Command\Generators;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;

use Workable\PackageGenerator\Command\AbstractCommand;

class MiddlewareMakeCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package-make:middleware';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new middleware';

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
            $this->error('-- Middleware already exists!');
            return;
        }

        $this->files->put($path, $this->compileStub());

        $this->info("-- Create middleware:". $path);

        $this->composer->dumpAutoloads();
    }

    /**
     * Compile the middleware stub.
     *
     * @return string
     * @throws FileNotFoundException
     */
    private function compileStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Http/Middleware/NameMiddleware.stub");
        $this->replaceNamespace($stub)
             ->replaceNameMiddleware($stub);

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
        $base_path = platform_path($platform.'/'. $package);
        return $base_path .'/src/Http/Middleware/'.$name .'.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the middleware'],
        ];
    }
}



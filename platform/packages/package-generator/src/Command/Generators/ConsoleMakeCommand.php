<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;

class ConsoleMakeCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package-make:console';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new console';

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
            $this->error('-- Console already exists!');
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileStub());

        $this->info("-- Create console:". $path);

        $this->composer->dumpAutoloads();
    }

    private function compileStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Command/NameConsole.stub");
        $this->replaceNamespace($stub)
            ->replaceNameConsole($stub);

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
        return $base_path .'/src/Console/'.$name .'.php';
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

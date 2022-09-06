<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Workable\PackageGenerator\Command\AbstractCommand;

class ModelMakeCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package-make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model';

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
        $this->handleOptionalMigrationOption();
    }

    public function fire()
    {
        $name           = $this->argument("name");
        $platform       = $this->option('platform');
        $package        = $this->option('package');

        $path = $this->getPath($name, $platform, $package);
        if ($this->files->exists($path))
        {
            $this->error('Model already exists!');
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileStub());

        $this->info("Create model:". $path);

        $this->composer->dumpAutoloads();
    }

    private function compileStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Model/NameModel.stub");
        $this->replaceNamespace($stub)
              ->replaceNameTable($stub)
             ->replaceNameModel($stub);

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
        $base_path = platform_path($platform.'/'. strtolower($package));
        return $base_path .'/src/Models/'.$name .'.php';
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

    /**
     * Make migration
     */
    public function handleOptionalMigrationOption()
    {
        if ($this->option('migration') === true)
        {
            $migrationName = 'create_' . $this->createMigrationName() . '_table';
            $this->call('package-make:migration', [
                'name' => $migrationName,
                '--package' => $this->option('package'),
                '--platform' => $this->option('platform')
            ]);
        }
    }
}

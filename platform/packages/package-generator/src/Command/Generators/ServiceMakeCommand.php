<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;

class ServiceMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service seed class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'service';

    /**
     * Meta information for the requested migration.
     *
     * @var array
     */
    protected $meta;


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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $name = $this->argument('name');
        $package = $this->option('package');
        $platform = $this->option('platform');
        $path = $this->getPath($name, $platform, $package);
        if ($this->files->exists($path)) {
            $this->error('Service already exists!');
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileStub());
        $this->info("Create service:" . $path);
        $this->composer->dumpAutoloads();
    }

    public function compileStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Services/NameService.stub");
        $this->replaceNamespace($stub)
            ->replaceNameService($stub)
            ->replaceModel($stub);

        return $stub;
    }

    public function replaceModel(&$stub)
    {
        $name = $this->argument('name');
        $name = str_replace(["Service", "service"], "", $name);
        $find = ["{{model}}", "{{model_lower}}"];
        $replace = [Str::ucfirst($name), Str::lower($name)];
        $stub = str_replace($find, $replace, $stub);
        return $this;
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param string $name
     * @return string
     */
    private function getPath($name, $platform, $package)
    {
        $base_path = platform_path($platform . '/' . $package);
        return $base_path . '/src/Services/' . Str::ucfirst($name) . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the service'],
        ];
    }

}

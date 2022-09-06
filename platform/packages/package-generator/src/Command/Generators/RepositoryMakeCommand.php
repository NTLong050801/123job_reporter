<?php


namespace Workable\PackageGenerator\Command\Generators;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Workable\Base\Supports\CliEcho;
use Workable\PackageGenerator\Command\AbstractCommand;

class RepositoryMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'repository';


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
        $name = $this->argument('name');
        $package = $this->option('package');
        $platform = $this->option('platform');
        $namespace = $this->option('namespace');

        $path = $this->getPath($name, $platform, $package);
        $pathInterface = $this->getPathInterface($name, $platform, $package);

        // Kiểm tra xem model attach trong repository có chưa
        try {
            Artisan::call("package-make:model", [
                "name" => $name,
                "--package" => $package,
                "--namespace" => $namespace,
                "--platform" => $platform
            ]);
            $this->info(Artisan::output());
        } catch (\Exception $e) {
            $this->warn("-- Create model with repository warning:" . $e->getMessage());
        }

        // Kiểm tra xem repository có chưa
        if ($this->files->exists($path)) {
            $this->error("Repository: {$path} already exists!");
            return;
        }

        $this->makeDirectory($path);
        $this->putRepository($path, $pathInterface);

        $this->info("Create repository:" . $path);
        $this->info("Create repositoryInterface:" . $pathInterface);
        $this->composer->dumpAutoloads();
    }

    /**
     * @param string $interface
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compileStub($interface = '')
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Repository/NameRepository" . $interface . ".stub");
        $this->replaceNamespace($stub)
            ->replaceNameRepository($stub)
            ->replaceModel($stub);

        return $stub;
    }

    /**
     * @param $stub
     * @return $this
     */
    public function replaceModel(&$stub)
    {
        $name = $this->argument('name');
        $find = ["{{model}}", "{{model_lower}}"];
        $replace = [Str::ucfirst($name), Str::lower($name)];
        $stub = str_replace($find, $replace, $stub);
        return $this;
    }

    /**
     * @param $path
     * @param $pathInterface
     */
    public function putRepository($path, $pathInterface)
    {
        $this->files->put($path, $this->compileStub());
        $this->files->put($pathInterface, $this->compileStub("Interface"));
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
        return $base_path . '/src/Repository/' . Str::ucfirst($name) . '/' . Str::ucfirst($name) . 'Repository.php';
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param string $name
     * @return string
     */
    private function getPathInterface($name, $platform, $package)
    {
        $base_path = platform_path($platform . '/' . $package);
        return $base_path . '/src/Repository/' . Str::ucfirst($name) . '/' . Str::ucfirst($name) . 'RepositoryInterface.php';
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the Repository'],
        ];
    }
}

<?php
namespace Workable\PackageGenerator\Command\Generators;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;

class SeedMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database seed class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seed';


    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    public function handle()
    {
        $this->setNames();
        $this->setMetaObject();
        $this->fire();

    }

    private function fire()
    {
        $name           = $this->argument("name");
        $platform       = $this->option('platform');
        $package        = $this->option('package');
        $path = $this->getPath($name, $platform, $package);
        if ($this->files->exists($path))
        {
            $this->error('-- Seeder already exists!');
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileStub());
    }

    private function compileStub()
    {
        $stub =  __DIR__ . '/../../../stubs/seed.stub';
        $stub = $this->files->get($stub);

        $this->replaceNamespace($stub)
            ->replaceObject($stub)
             ->replaceNameSeeder($stub);

        return $stub;
    }

    private function replaceNameSeeder(string &$stub)
    {
        $name  = $this->argument("name");
        $stub  = str_replace('{{NameSeeder}}', $name, $stub);
        return $this;
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name, $platform, $package)
    {
        $base_path = platform_path($platform.'/'. $package);
        return $base_path . '/src/Database/Seeders/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the seeder'],
        ];
    }
}

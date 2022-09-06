<?php


namespace Workable\PackageGenerator\Command\Generators;

use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Workable\PackageGenerator\Command\AbstractCommand;
use Workable\PackageGenerator\Support\Migrations\NameParser;
use Workable\PackageGenerator\Support\Migrations\SchemaParser;
use Workable\PackageGenerator\Support\Migrations\SyntaxBuilder;
use Symfony\Component\Console\Input\InputArgument;

class MigrationMakeCommand extends AbstractCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package-make:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration class and apply schema at the same time';

    /**
     * Meta information for the requested migration.
     *
     * @var array
     */
    protected $meta;

    protected $package;

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
        $this->fire();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->meta = (new NameParser)->parse($this->argument('name'));
        $this->makeMigration();

    }

    /**
     * Get the application namespace.
     *
     * @return string
     */
    protected function getAppNamespace()
    {
        return Container::getInstance()->getNamespace();
    }

    /**
     * Generate the desired migration.
     */
    protected function makeMigration()
    {
        $name    = $this->argument('name');
        $package = $this->option('package');
        $platform = $this->option('platform');

        $path = $this->getPath($name, $package, $platform);

        if ($this->files->exists($path))
        {
            $this->error($path . ' already exists!');
            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->compileMigrationStub());

        $this->info('Created Migration:'. $path);

        $this->info('Migration created successfully.');

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the path to where we should store the migration.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name, $package, $platform)
    {
        $base_path = platform_path($platform.'/'. $package);

        return $base_path . '/src/Database/Migrations/' . date('Y_m_d_His') . '_' . $name . '.php';
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getModelPath($name)
    {
        $name = str_replace($this->getAppNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Compile the migration stub.
     *
     * @return string
     */
    protected function compileMigrationStub()
    {
        $stub = $this->files->get(__DIR__ . '/../../../stubs/migration.stub');

        $this->replaceClassName($stub)
            ->replaceSchema($stub)
            ->replaceTableName($stub);

        return $stub;
    }

    /**
     * Replace the class name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceClassName(&$stub)
    {
        $className = ucwords(Str::camel($this->argument('name')));

        $stub = str_replace('{{class}}', $className, $stub);

        return $this;
    }

    /**
     * Replace the table name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceTableName(&$stub)
    {
        $table = $this->meta['table'];

        $stub = str_replace('{{table}}', $table, $stub);

        return $this;
    }

    /**
     * Replace the schema for the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceSchema(&$stub)
    {
        if ($schema = $this->option('schema'))
        {
            $schema = (new SchemaParser)->parse($schema);
        }
        $schema = (new SyntaxBuilder)->create($schema, $this->meta);

        $stub = str_replace(['{{schema_up}}', '{{schema_down}}'], $schema, $stub);

        return $this;
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

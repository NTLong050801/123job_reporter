<?php


namespace Workable\PackageGenerator\Command;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Workable\PackageGenerator\Support\PackageSupport;

abstract class AbstractCommand extends Command
{

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * @var
     */
    protected $package;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $nameClass;

    /**
     * @var
     */
    protected $namePlural;

    /**
     * @var
     */
    protected $optionArr = [];

    /**
     * Contain properties to replace stub
     * @var array
     */
    protected $metaObject = [];

    /**
     * @var string
     */
    protected $objectName;


    /**
     * Create a new command instance.
     *
     * @param  Filesystem  $files
     * @param  Composer  $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    protected function setNames()
    {
        $className = ucwords(Str::camel($this->option('package')));
        $name = $this->argument('name');
        $this->namespace = $this->option('namespace') . '\\' . $className;
        $this->nameClass = Str::ucfirst($name);
        $this->namePlural = $this->createMigrationName();
        $this->package = $this->option('package');
    }

    /**
     * Lay ten object
     * @param $name
     * @return string
     */
    protected function getNameObject($name)
    {
        return Str::snake($name);
    }

    protected function setMetaObject($name = null)
    {
        $name = $this->argument("name");
        $name = str_replace(["Controller", "controller"], "", $name);

        $this->metaObject = [
            "{{model}}" => $this->getNameObject($name),
            "{{model_lower}}" => Str::camel($name),
            "{{model_name}}" => Str::ucfirst($name),
            "{{routeName}}" => Str::kebab($name),
            "{{tableName}}" => Str::plural(Str::snake($name)),
            "{{package}}" => $this->option("package"),
            "{{platform}}" => $this->option("platform"),
        ];
    }

    /**
     * @param $stub
     * @return $this
     */
    public function replaceObject(string &$stub): AbstractCommand
    {
        $stub = str_replace(array_keys($this->metaObject), array_values($this->metaObject), $stub);

        return $this;
    }

    protected function createMigrationName()
    {
        return Str::plural(Str::snake($this->argument('name')));
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = [
            ['package', 'p', InputOption::VALUE_OPTIONAL, 'Optional name package to be attached to the migration', PackageSupport::getPackage()],
            ['platform', 'pl', InputOption::VALUE_OPTIONAL, 'Optional platform to be attached to the migration', PackageSupport::getPlatform()],
            ['namespace', 'na', InputOption::VALUE_OPTIONAL, 'Optional platform to be attached to the migration', PackageSupport::getNameSpace()],
            ['schema', 's', InputOption::VALUE_OPTIONAL, 'Optional schema to be attached to the migration', null],
            ['api', 'api', InputOption::VALUE_OPTIONAL, 'Optional Api to be attached to the controller', null],
            ['migration', 'm', InputOption::VALUE_NONE, 'Flag to create associated migrations', null],
            ['fillable', null, InputOption::VALUE_OPTIONAL, 'The fillable attributes.', null],
            ['interactive', 'i', InputOption::VALUE_OPTIONAL, 'Interactive mode.', null],
            ['enum', '-e', InputOption::VALUE_OPTIONAL, 'Option name enum to be create to enum.', null]
        ];
        return $options;
    }

    /**
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replacePackage(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{package}}', $this->package, $stub);
        return $this;
    }

    /**
     * Replace namespace
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNamespace(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{namespace}}', $this->namespace, $stub);

        return $this;
    }

    /**
     * Replace name table
     * @param string $stub
     * @return $this
     */
    public function replaceNameTable(string &$stub)
    {
        $stub = str_replace('{{table}}', $this->namePlural, $stub);
        return $this;
    }

    /**
     * Replace name quest
     * @param string $stub
     * @return AbstractCommand
     */
    public function replaceNameRequest(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameRequest}}', $this->nameClass, $stub);

        return $this;
    }

    /**
     * Replace name service
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameService(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameService}}', $this->nameClass, $stub);
        return $this;
    }

    /**
     * Replace name repository
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameRepository(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameRepository}}', $this->nameClass . 'Repository', $stub);
        $stub = str_replace('{{NameRepositoryInterface}}', $this->nameClass . 'RepositoryInterface', $stub);

        return $this;
    }

    /**
     * Replace name controller
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameController(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameController}}', $this->nameClass, $stub);

        return $this;
    }

    /**
     * Replace name middleware class
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameMiddleware(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameMiddleware}}', $this->nameClass, $stub);

        return $this;
    }

    /**
     * Replace name console class
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameConsole(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameConsole}}', $this->nameClass, $stub);

        return $this;
    }

    /**
     * @param string $stub
     * @return AbstractCommand
     */
    public function replaceNameRoute(string &$stub): AbstractCommand
    {
        $suffix = ["controller", "Controller"];
        $nameObject = $this->nameClass;
        $nameObject = !Str::contains($nameObject, $suffix) ? $nameObject . 'Controller' : $nameObject;
        $aliasName = str_replace($suffix, '', $nameObject);
        $aliasName = Str::kebab($aliasName);

        $search = ['{{ $nameController }}', '{{ $aliasName }}'];
        $replace = [$nameObject, $aliasName];
        $stub = str_replace($search, $replace, $stub);

        return $this;
    }

    /**
     * Replace name model class
     * @param string $stub
     * @return AbstractCommand
     */
    protected function replaceNameModel(string &$stub): AbstractCommand
    {
        $stub = str_replace('{{NameModel}}', $this->nameClass, $stub);

        return $this;
    }
}

<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;
use Workable\PackageGenerator\Support\PackageSupport;

class EnumMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:enum';
    protected $description = 'Create enum for object';

    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    public function handle()
    {
        $this->setNames();
        $enums = $this->option("enum");
        $name = $this->argument("name");
        if (!$enums)
        {
            $enums = PackageSupport::instance()->get("enum_default");
        }
        else
        {
            $enums = explode(',', $enums);
        }

        foreach ($enums as $enum) {
            $this->fire(trim($enum), $name);
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function fire($enum, $name)
    {
        $package = $this->option("package");
        $platform = $this->option("platform");

        $path = $this->getPath($name, $enum, $package, $platform);
        if ($this->files->exists($path)) {
            $this->error('Enum: ' . $path . ' already exists!');
            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileEnumStub($name, $enum));
        $this->info('Created Enum:' . $path);
        $this->info('Enum created successfully.');
    }

    /**
     * @param $name
     * @param $package
     * @param $platform
     */
    private function getPath($name, $enum, $package, $platform)
    {
        $base_path = platform_path($platform . '/' . $package);
        $nameClass = $this->getNameClass($name, $enum);
        $base_path .= '/src/Enum/' . $nameClass;
        return $base_path;
    }

    /**
     * @param $enum
     * @return string
     * @throws \Exception
     */
    private function getPathEnum($enum)
    {
        $enums = PackageSupport::instance()->get("stubs.enum");
        $enum = $enums[$enum] ?? null;
        if (!$enum) {
            throw new \Exception("Enum:" . $enum . ' not support in config package-generator.stubs.enum');
        }

        return __DIR__ . '/../../../' . ltrim($enum, '/');
    }

    /**
     * @param $name
     * @param $enum
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function compileEnumStub($name, $enum)
    {
        $enumPath = $this->getPathEnum($enum);
        $stub = $this->files->get($enumPath);
        $this->replaceNamespace($stub)
            ->replaceNameClass($name, $enum, $stub);

        return $stub;
    }

    /**
     * @param $name
     * @param $enum
     * @param $stub
     * @return $this
     */
    private function replaceNameClass($name, $enum, &$stub)
    {
        $nameClass = $this->getNameClass($name, $enum, '');
        $stub = str_replace("{{NameEnumClass}}", $nameClass, $stub);
        return $this;

    }

    /**
     * @param $name
     * @param $enum
     * @param string $extention
     * @return string
     */
    private function getNameClass($name, $enum, $extention = '.php')
    {
        return Str::ucfirst($name) . Str::ucfirst($enum) . 'Enum' . $extention;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The names of enum will be created.'],
        ];
    }
}

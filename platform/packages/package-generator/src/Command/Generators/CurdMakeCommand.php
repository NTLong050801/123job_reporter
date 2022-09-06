<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;
use Workable\PackageGenerator\Support\CurdPackageGenerator;

class CurdMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:curd';
    protected $description = 'Create package auto';

    /**
     * CurdMakeCommand constructor.
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    /**
     *
     */
    public function handle()
    {
        if ($this->shouldFire())
        {
            $this->fire();
        }
    }

    /**
     * @return int
     */
    public function shouldFire()
    {
        if (!$this->option('schema'))
        {
            $this->error('-- The "schema" argument is required!');
            return 0;
        }
        return 1;
    }

    /**
     *
     */
    public function fire()
    {
        $name = $this->argument('name');
        $options = $this->options();
        (new CurdPackageGenerator($name, $options))
            ->generate();
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

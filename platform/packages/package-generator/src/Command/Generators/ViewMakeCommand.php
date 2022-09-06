<?php


namespace Workable\PackageGenerator\Command\Generators;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Workable\PackageGenerator\Command\AbstractCommand;
use Workable\PackageGenerator\Support\Migrations\SchemaParser;
use Workable\PackageGenerator\Support\PackageSupport;
use Workable\PackageGenerator\Support\View\ViewSyntaxBuilder;

class ViewMakeCommand extends AbstractCommand
{
    protected $name = 'package-make:view';
    protected $description = 'Create new resources views';
    protected $viewName;

    /**
     * ViewMakeCommand constructor.
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files, $composer);
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->setNames();
        $this->setMetaObject();
        $this->fire();
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function fire()
    {
        $name = $this->argument("name");
        $this->viewName = Str::lower($this->argument("view") ?? 'index');
        if ($this->viewName == 'all') {
            $viewAll = PackageSupport::instance()->get('stubs.view_list');
            foreach ($viewAll as $view) {
                $this->viewName = $view;
                $this->makeView($name);
            }
        } else {
            $this->makeView($name);
        }
    }

    /**
     * @param $name
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function makeView($name)
    {
        $platform = $this->option('platform');
        $package = $this->option('package');
        $path = $this->getPath($platform, $package, $name);

        if ($this->files->exists($path)) {
            $this->error("View {$path} already exists!");
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->compileStub());
        $this->info("Create view: {$path}");
    }

    /**
     * @param $platform
     * @param $package
     * @param $name
     * @return string
     */
    public function getPath($platform, $package, $name)
    {
        $base_path = platform_path($platform . '/' . $package);
        return $base_path . "/resources/views/backend/{$this->getNameObject($name)}/" . $this->viewName . '.blade.php';
    }

    /**
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compileStub()
    {
        $stub = $this->files->get(__DIR__ . "/../../../stubs/Resource/views/{$this->viewName}.blade.stub");
        if ($this->option('schema')) {
            $this->replaceSchema($stub);
        }

        $this->replaceObject($stub);
        $stub = $this->indentContent($stub);

        return $stub;
    }

    /**
     * @param string $stub
     */
    private function replaceSchema(string &$stub): ViewMakeCommand
    {
        if ($schema = $this->option('schema')) {
            $schema = (new SchemaParser())->parse($schema);
        }

        $stub = (new ViewSyntaxBuilder($this->viewName, $this->files))->create($schema);
        return $this;
    }

    /**
     * @param $content
     * @param string $tab
     *
     * @return string
     * @See https://stackoverflow.com/questions/7838929/keeping-line-breaks-when-using-phps-domdocument-appendchild
     */
    protected function indentContent($content, $tab = "\t")
    {
        $indent = 0;

        // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
        $content = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $content);

        // now indent the tags
        $token = strtok($content, "\n");
        $result = ''; // holds formatted version as it is built
        $pad = 0; // initial indent
        $matches = []; // returns from preg_matches()

        // scan each line and adjust indent based on opening/closing tags
        while ($token !== false) {
            $token = trim($token);
            // test for the various tag states

            // 1. open and closing tags on same line - no change
            if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) {
                $indent = 0;
            }
            // 2. closing tag - outdent now
            elseif (preg_match('/^<\/\w/', $token, $matches)) {
                $pad--;
                if ($indent > 0) {
                    $indent = 0;
                }
            }
            // 3. opening tag - don't pad this one, only subsequent tags
            elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) {
                $indent = 1;
            }
            // 4. no indentation needed
            else {
                $indent = 0;
            }

            // pad the line with the required number of leading spaces
            $line = str_pad($token, strlen($token) + $pad, $tab, STR_PAD_LEFT);
            $result .= $line."\n"; // add to the cumulative result, with linefeed
            $token = strtok("\n"); // get the next token
            $pad += $indent; // update the pad size for subsequent lines
        }

        return $result;
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
            ['view', InputArgument::REQUIRED, 'The name of the view'],
        ];
    }
}

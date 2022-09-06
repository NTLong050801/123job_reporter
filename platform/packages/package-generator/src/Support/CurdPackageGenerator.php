<?php

namespace Workable\PackageGenerator\Support;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Workable\Base\Supports\CliEcho;

class CurdPackageGenerator
{
    protected $name;
    protected $platform;
    protected $namespace;
    protected $package;
    protected $schema;
    protected $api;
    protected $enum;

    /**
     * CurdPackageGenerator constructor.
     * @param $name
     * @param array $options
     */
    public function __construct($name, $options = [])
    {
        $this->name = $name;
        $this->platform = $options['platform'];
        $this->namespace = $options['namespace'];
        $this->package = $options['package'];
        $this->api = $options['api'];
        $this->enum = $options['enum'];
    }

    private function paramOption($params = [])
    {
        $paramRtn = [
            '--platform' => $this->platform,
            '--package' => $this->package,
            '--namespace' => $this->namespace,
            '--schema' => $this->schema,
            '--api' => $this->api,
            '--enum' => $this->enum
        ];
        if ($params) {
            $paramRtn = array_merge($params, $paramRtn);
        }
        return $paramRtn;
    }

    /**
     * Model
     */
    private function model(): void
    {
        $name = Str::ucfirst(Str::camel($this->name));
        $params = [
            "name" => $name,
        ];
        $this->callArtisan("package-make:model", $params, "model");
    }

    /**
     * Migration
     */
    private function migration(): void
    {
        $namePluralLower = Str::plural(Str::snake($this->name));
        $params = [
            "name" => "create_{$namePluralLower}_table"
        ];
        $this->callArtisan("package-make:migration", $params, "migration");
    }

    /**
     *
     */
    protected function request(): void
    {
        $params = [
            "name" => "{$this->name}Request",
        ];
        $this->callArtisan("package-make:request", $params, "request");
    }

    /**
     *
     */
    protected function repository()
    {
        $params = [
            "name" => "{$this->name}",
        ];
        $this->callArtisan("package-make:repository", $params, "repository");
    }

    /**
     *
     */
    private function service(): void
    {
        $params = [
            "name" => "{$this->name}Service",
        ];
        $this->callArtisan("package-make:service", $params, "service");
    }

    /**
     *
     */
    protected function controller(): void
    {
        $name = Str::ucfirst($this->name);
        $params = [
            "name" => "{$name}Controller",
        ];
        $this->callArtisan("package-make:controller", $params, "controller");
    }

    /**
     * Make route
     */
    protected function route(): void
    {
        $name = Str::ucfirst($this->name);
        $params = [
            "name" => "{$name}Controller",
        ];
        $this->callArtisan("package-make:route", $params, "route");
    }

    public function lang($name)
    {
        $param = [
            'name' => $name,
        ];
//        $this->callArtisan('package-package:lang', $param, 'lang');
    }

    public function nav($name)
    {
        $param = [
            'name' => $name,
        ];
//        $this->callArtisan('package-package:nav', $param, 'nav');
    }

    public function breadcrumbs(string $name, string $view = null, string $parent = null): void
    {
        $params = ['name' => $name];

        if ($view) {
            $params['view'] = $view;
        }

        if ($parent) {
            $params['--parent'] = $parent;
        }

        if ($parent != 'index') {
            $params['--argparent'] = true;
        }

        if ($view != 'create') {
            $params['--ownarg'] = true;
        }

//        $this->callArtisan("package-make:breadcrumb", $params, 'breadcrumb');
    }

    /**
     * @param string $name
     * @param string|null $view
     * @param string $schema
     *
     * @return void
     */
    public function viewFile(string $name, string $view = null, string $schema = null): void
    {
        $params = [
            "name" => $name
        ];
        $params['view'] = $view ?: "index";
        $this->callArtisan("package-make:view", $params, 'view');
    }

    /**
     *
     */
    protected function view()
    {
        if ($this->api) return;
        $name = $this->name;
//        $this->lang($name);
//        $this->nav($name);

        // create view index
//        $this->breadcrumbs($name);
        $this->viewFile($name);

//        // create view create
//        $this->breadcrumbs($name, 'create', 'index');
//        $this->viewFile($name, 'create', $this->schema);
//
//        // create view show
//        $this->breadcrumbs($name, 'show', 'index');
//        $this->viewFile($name, 'show');
//
//        // create view edit
//        $this->breadcrumbs($name, 'edit', 'show');
//        $this->viewFile($name, 'edit', $this->schema);
//
//        // create view delete
//        $this->breadcrumbs($name, 'delete', 'show');
//        $this->viewFile($name, 'delete');

        CliEcho::infonl("Views '" . Str::snake($this->name) . "' created");
    }


    /**
     *
     */
    protected function tests()
    {

    }

    /**
     *
     */
    public function enum()
    {
        $params = [
            'name' => $this->name
        ];
        $this->callArtisan("package-make:enum", $params, "enum");
    }

    public function factory()
    {
        $params = [
            'name' => $this->name
        ];
        $this->callArtisan("package-make:factory", $params, "factory");
    }

    /**
     * @param $name
     * @param $params
     * @param string $type
     */
    private function callArtisan($name, $params, $type = '')
    {
        $params = $this->paramOption($params);
        try {
            Artisan::call($name, $params);
            CliEcho::infonl(Artisan::output());
        } catch (\Exception $e) {
            CliEcho::warningnl("Unable to create {$type}. {$e->getMessage()}");
        }
    }

    /**
     * Generate all command
     */
    public function generate()
    {
//        $this->model();
//        $this->migration();
//        $this->request();
//        $this->repository();
//        $this->service();
//        $this->controller();
//        $this->route();
//        $this->enum();
        $this->view();

        // Create schema
        \CliEcho::successnl('Run "php artisan migrate" to complete');
    }
}

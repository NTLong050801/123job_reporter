<?php


namespace Workable\Base\Providers;


use Composer\Autoload\ClassLoader;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AnalyzerServiceProvider extends ServiceProvider
{
    protected $namePlugin = 'plugin.json';

    public function boot()
    {
        // && Schema::hasTable('settings')
        if (check_db_conn())
        {
            $analyzers = get_active_analyzer();
            if (!empty($analyzers) && is_array($analyzers)) {
                $this->loadAnalyzer($analyzers);
            }
        }
    }

    /**
     * Load plugin
     * @param array $plugins
     * @throws
     */
    private function loadAnalyzer($plugins = [])
    {
        $providers = []; // Chứa danh sách provider cung cấp
        $namespaces = []; // Chứa danh sách namespace

        if (empty($namespaces) || empty($providers)) {
            foreach ($plugins as $plugin => $pluginStatus) {
                $pluginPath = analyzer_path($plugin);
                $pluginPathJson = $pluginPath . '/' . $this->namePlugin;

                if (file_exists($pluginPathJson) && $pluginStatus) {
                    $content = get_file_data($pluginPathJson);
                    if (!empty($content)) {
                        $providerPlugin = $content['provider'];
                        $namespacePlugin = $content['namespace'];

                        if (Arr::has($content, 'namespace') && !class_exists($providerPlugin)) {
                            $namespaces[$plugin] = $namespacePlugin;
                        }

                        $providers[] = $providerPlugin;
                    }
                }
            }

            $this->__setNameSpacePlugin($namespaces);
            $this->__registerProviderPlugin($providers);
        }
    }

    /**
     * @param array $namespaces
     */
    private function __setNameSpacePlugin($namespaces = [])
    {
        if ($namespaces) {
            $loader = new ClassLoader();
            foreach ($namespaces as $key => $namespace) {
                $loader->setPsr4($namespace, plugin_path($key . '/src'));
            }
            $loader->register();
        }
    }

    /**
     * @param array $providers
     */
    private function __registerProviderPlugin($providers = [])
    {
        if ($providers) {
            foreach ($providers as $provider) {
                if (class_exists($provider)) {
                    $this->app->register($provider);
                }
            }
        }
    }

    public function register()
    {

    }
}

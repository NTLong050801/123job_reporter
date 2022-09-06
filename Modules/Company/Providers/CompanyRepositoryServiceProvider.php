<?php
/**
 * Created by PhpStorm.
 * User: Windows 10 Gamer
 * Date: 20/05/2020
 * Time: 11:21 SA
 */

namespace Modules\Company\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $models             = [
            'Menu',
            'Module',
            'Profile'
        ];
        $namespace_frontend = "Modules\\Company\\Repository\\";
        foreach ($models as $model)
        {
            $this->app->singleton(
                $namespace_frontend . $model . '\\' . $model . 'RepositoryInterface',
                $namespace_frontend . $model . '\\' . $model . 'Repository'
            );
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}

<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Workable\Acl\Enum\RoleEnum;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'production') \URL::forceScheme('https');

//        $running_mode = $this->app->runningInConsole() ? "cli" : "laravel";
//        $pathStorage = storage_path('logs/') . $running_mode . '.log';
//        config()->set('logging.channels.daily.path', $pathStorage);

       $this->app->register(AdminLoadServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->bladeDirectives();
    }

    private function bladeDirectives()
    {
        // \Artisan::call('view:clear');
        Blade::directive('permission', function ($permission) {
            $check= 0;
            $current_user = Auth::guard('admins')->user();
            if ($current_user->isAdministrator()) {
                $check=1;
            }
            else{
                // dd(13);
                $check= $current_user->can($permission) ? 1 : 0;
            }
            // dd($check);
            return "<?php  if({$check}) { ?>";
        });

        Blade::directive('endpermission', function ($permission) {
            return "<?php } ?>";
        });

        Blade::directive('isadmin', function ($permission) {
            $current_user = Auth::guard('admins')->user();
            $check = $current_user->roles[0]->name == RoleEnum::SUPER_ADMIN ? 1 : 0;
            // dump($current_user->roles[0]->name);
            return "<?php  if( {$check} ) { ?>";
        });

        Blade::directive('endisadmin', function ($permission) {
            return "<?php } ?>";
        });
    }
}

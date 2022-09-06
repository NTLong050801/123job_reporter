<?php
namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Workable\Support\Traits\FlashMessages;
use Auth;
use Workable\Acl\Enum\RoleEnum;

class AdminLoadServiceProvider extends ServiceProvider
{
    use FlashMessages;

    public function boot()
    {
      
        // $this->bladeDirectives();
    }

    public function register()
    {
        $this->findModule();

        view()->composer('company::blocks.messages', function ($view) {
            $messages = self::messages();
            return $view->with('messages', $messages);
        });
    }

    private function findModule()
    {
        $uri = $this->detectSegment();
        if (Schema::hasTable('menus'))
        {
            $menu = DB::table('menus')->where('menu_slug', $uri)->first();
            if ($menu)
            {
                config()->set('menu.menu_id', $menu->id);
                config()->set('menu.menu_item', $menu);
            }
        }
    }

    protected function detectSegment()
    {
        $configAdmin = config('common.admin.prefix');
        $uri = request()->segments();
        if ($uri) {
            $uri = $configAdmin ? $uri[1] : $uri[0];
            $uri = trim($uri, '/');
            $uri = str_replace($configAdmin, '', $uri);
            $uri = trim($uri, '/');
            return $uri;
        }
    }

    
}

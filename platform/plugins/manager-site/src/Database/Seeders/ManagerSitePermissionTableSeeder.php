<?php

namespace Workable\ManagerSite\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class ManagerSitePermissionTableSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/manager-site/config/permission.php';

    public function run()
    {
        parent::run();
    }
}

// php artisan db:seed --class=\\Workable\\ManagerSite\\Database\\Seeders\\ManagerSitePermissionTableSeeder



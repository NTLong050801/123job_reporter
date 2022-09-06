<?php
namespace Workable\GoogleLog\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class GoogleLogPermission extends PermissionTableSeeder
{
    protected $path_config = 'plugins/google-log/config/permission.php';
    public function run()
    {
        parent::run();
    }
}

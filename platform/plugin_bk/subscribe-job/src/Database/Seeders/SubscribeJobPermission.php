<?php
namespace Workable\SubscribeJob\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class SubscribeJobPermission extends PermissionTableSeeder
{
    protected $path_config = 'plugins/subscribe-job/config/permission.php';
    public function run()
    {
        parent::run();
    }
}

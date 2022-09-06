<?php
namespace Workable\RobotLog\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class RobotLogPermission extends PermissionTableSeeder
{
    protected $path_config = 'plugins/robot-log/config/permission.php';
    public function run()
    {
        parent::run();
    }
}

<?php
namespace Workable\ApplyJob\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class ApplyJobPermission extends PermissionTableSeeder
{
    protected $path_config = 'plugins/apply-job/config/permission.php';
    public function run()
    {
        parent::run();
    }
}

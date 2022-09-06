<?php

namespace Workable\Candidate\Database\Seeders;

use Faker\Factory;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Database\Seeders\PermissionTableSeeder;
use Workable\Candidate\Models\Candidate;

class ReportCandidatePermissionSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/candidate/config/permission.php';


    public function run()
    {
        parent::run();
    }

}

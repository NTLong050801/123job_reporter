<?php

namespace Workable\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { DB::table('admin_role_user')->truncate();
        DB::table('admin_role_user')->insert([
            array('role_id' => '1','admin_id' => '1','active'=>'1','created_at' => now(),'updated_at' => now()),
        ]);
    }
}

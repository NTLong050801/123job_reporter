<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $items = require_once (module_path('Company').'/Database/Files/admin.php');
        foreach ($items as $item)
        {
            $password = bcrypt("admin12345");
            $item['password'] = $password;
            DB::table('admins')->insert($item);
        }
    }
}

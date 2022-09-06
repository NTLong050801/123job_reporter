<?php

namespace Modules\Report\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RobotDatabaseSeeder extends Seeder
{

    public function run() {
        Model::unguard();

        $faker = Factory::create();
        $limit = 50;
        for ( $i=0; $i< $limit; $i++) {
            DB::table('robots')->insert([
                'site_id' => rand(1,10),
                'time' => $faker->dateTimeThisMonth(),
                'google_count' => rand(1,3000),
                'google_time' => rand(1,3000),
                'coc_count' => rand(1,3000),
                'coc_time'=>rand(1,3000),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

}

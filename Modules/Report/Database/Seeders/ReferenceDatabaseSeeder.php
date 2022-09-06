<?php

namespace Modules\Report\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceDatabaseSeeder extends Seeder
{

    public function run() {
        Model::unguard();

        $faker = Factory::create();
        $limit = 50;
        for ( $i=0; $i< $limit; $i++) {
            DB::table('references')->insert([
                'site_id' => rand(1,10),
                'time' => $faker->dateTimeThisMonth(),
                'address' => rand(1,3000),
                'salary' => rand(1,3000),
                'level' => rand(1,3000),
                'category'=>rand(1,3000),
                'title'=>rand(1,3000),
                'company'=>rand(1,3000),
                'work_type'=>rand(1,3000),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

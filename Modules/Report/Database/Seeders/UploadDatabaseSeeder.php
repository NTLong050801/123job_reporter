<?php

namespace Modules\Report\Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UploadDatabaseSeeder extends Seeder
{

    public function run() {
        Model::unguard();

        $faker = Factory::create();
        $limit = 50;
        for ( $i=0; $i< $limit; $i++) {
            DB::table('public_uploads')->insert([
                'site_id' => rand(1,10),
                'time' => $faker->dateTimeThisMonth(),
                'count_get' => rand(1,3000),
                'count_create' => rand(1,3000),
                'count_update' => rand(1,3000),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

}

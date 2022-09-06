<?php

namespace Workable\Organization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = $this->getCompany();
        $faker = \Faker\Factory::create();

        foreach ($companies as $company)
        {
            for ($i = 0; $i < 100; $i++)
            {
                \CliEcho::infonl('-- Running:'. $i);
                $data = [
                    'company_id' => $company,
                    'type' => random_int(1, 2),
                    'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'hash_tag' => null,
                    'status' => random_int(0, 1),
                    'must_read' => random_int(0, 1),
                    'content' => $faker->text(1000),
                ];
                $this->insert($data);
            }
        }
    }

    private function insert($data)
    {
        $data['created_at'] = now();
        $data['updated_at'] = now();
        DB::table('announcements')->insert($data);
    }

    private function getCompany()
    {
        return DB::table('companies')->pluck('id');
    }
}

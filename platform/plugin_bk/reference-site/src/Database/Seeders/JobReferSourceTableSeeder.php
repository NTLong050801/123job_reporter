<?php
namespace Workable\ReferenceSite\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;

class JobReferSourceTableSeeder extends Seeder
{
    private function getFirstLocation()
    {
        return DB::table("locations")->where("loc_level",1 )->inRandomOrder()->first();
    }

    private function getFirstCategory()
    {
        return DB::table("careers")->inRandomOrder()->first();
    }

    private function getFirstSalary()
    {
        return DB::table("attributes")->where("type", 1)->inRandomOrder()->first();
    }

    private function getSites()
    {
        return  [
            "vietnamworks.com",
            "topcv.vn",
            "careerbuilder.vn",
            "itviec.com",
            "topdev.vn",
            "hoteljob.vn",
            "chefjob.vn",
            "mywork.com.vn",
            "timviecnhanh.com",
            "careerlink.vn",
            "vieclam24h.vn",
            "viectotnhat.com",
            "jobsgo.vn",
            "tuyencongnhan.vn",
            "timviec365.com",
            "goodcv.vn",
            "iconicjob.vn",
            "indeed.com",
            "jobstreet",
            "ybox.vn",
            "linkedin.com",
            "glints.com",
            "jobpro.vn",
            "jobnow.com.vn",
            "timviec.com.vn",
            "freec.asiajobs",
            "talentsearch.vn",
            "http:jobsvietnam.net",
            "hrvietnam.com",
            "http:vieclamhcm.net",
            "tutimviec.com",
            "vieclambank.com",
            "chonviec.com",
            "www.hr2b.com",
            "www.careerjet.vn",
            "hrc.com.vn"
        ];
    }

    public function run()
    {
        $sites = $this->getSites();

        for ($i=1; $i < 40000; $i++)
        {
            $locationFirst = $this->getFirstLocation();
            $locationTwo = $this->getFirstLocation();

            $categoryFirst = $this->getFirstCategory();
            $categoryTwo   = $this->getFirstCategory();
            $salaryFirst   = $this->getFirstSalary();
            $salaryTwo     = $this->getFirstSalary();

            CliEcho::infonl("-- Fake data: ". $i);

            $metaData = [
                "salary" => [
                    [
                        "id" => $salaryFirst->id,
                        "name" => $salaryFirst->name
                    ],
                    [
                        "id" => $salaryTwo->id,
                        "name" => $salaryTwo->name
                    ]
                ],
                "city"  => [
                    [
                        "id"   => $locationFirst->id,
                        "name" => $locationFirst->loc_name
                    ],
                    [
                        "id"   => $locationTwo->id,
                        "name" => $locationTwo->loc_name
                    ],
                ],
                "district"  => [

                ],
                "category" => [
                    [
                        "id" => $categoryFirst->id,
                        "name" => $categoryFirst->ca_name
                    ],
                    [
                        "id" => $categoryTwo->id,
                        "name" => $categoryTwo->ca_name
                    ]
                ]
            ];

            $provider = Arr::random([0, 2]);
            $siteName = $provider == 0 ? Arr::random($sites) : 'facebook.com';

            $randomDay = random_int(0, 200);
            $day    = now()->subDays($randomDay)->toDateTimeString();

            $dataInsert = [
                "source_id" => $i,
                "app_int" => 1,
                "app_text" => "123job",
                "site_name" => $siteName,
                "provider_id" => $provider,
                "meta_data" => "",
                "meta_data_transform" => json_encode($metaData),
                "meta_agent" => null,
                "meta_agent_transform" => null,
                "source_created_at" => $day,
                "updated_at" => $day,
                "created_at" => $day,
            ];
            $this->__store($dataInsert);
        }
    }

    /**
     * __store
     * @param array $data
     * User: Hungokata
     * Date: 2021/06/07 - 15:32
     */
    private function __store($data= [])
    {
        CliEcho::infonl('-- Store:' . print_r($data, true));

        DB::table("job_refer_sources")->insert($data);
    }
}

<?php
namespace Workable\SubscribeJob\Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Workable\Base\Supports\CliEcho;

class SubscribeJobTableSeeder extends Seeder
{
    private function getFirstLocation()
    {
        return DB::table("locations")->where("loc_level",1 )->inRandomOrder()->first();
    }

    private function getFirstSalary()
    {
        return DB::table("attributes")->where("type", 1)->inRandomOrder()->first();
    }

    protected function getKeyword()
    {
        return [
            "tuyển nhân viên kinh doanh",
            "việc làm bán thời gian",
            "finance manager",
            "việc làm kế toán",
            "tuyển kế toán trưởng",
            "tuyển dụng kế toán tổng hợp",
            "trưởng phòng nhân sự",
            "nhân viên hành chính nhân sự",
            "việc làm xây dựng",
            "nhân viên văn phòng tiếng anh",
            "tuyển trợ giảng tiếng anh",
            "phiên dịch tiếng trung",
            "tuyển giảng viên",
            "tuyển thiết kế đồ họa",
            "nhân viên giao hàng",
            "tuyển dụng digital marketing",
            "tuyển dụng kỹ sư điện",
            "tuyển nhân viên nhập liệu"
        ];
    }

    protected function getSource()
    {
        return [
            "footer",
            "sidebar",
            "footer_mobile",
            "scroll_pc",
            "scroll_mb"
        ];
    }

    public function run()
    {
        for ($i = 1; $i <= 10000; $i++)
        {
            CliEcho::infonl("-- Fake subscribe:". $i);

            $keyword = $this->getKeyword();
            $cityItem = $this->getFirstLocation();
            $salaryItem = $this->getFirstSalary();

            $usk_meta_loc = [
                "city" => $cityItem->id
            ];

            $uskMetaLoc = json_encode($usk_meta_loc);

            $randomDay = random_int(0, 200);
            $day    = now()->subDays($randomDay)->toDateString();

            $dataSubscribe = [
                "source_id"           => $i,
                "app_int"             => 1,
                "app_text"            => "123job",
                "usk_meta_loc"        => $uskMetaLoc,
                "usk_keyword"         => Arr::random($keyword),
                "usk_city"            => $cityItem->loc_name,
                "usk_district"        => "",
                "usk_salary"          => $salaryItem->name,
                "usk_email"           => "hungitc.hubt@gmail.com",
                "usk_phone"           => "0333383630",
                "usk_source"          => Arr::random($this->getSource()),
                "usk_agent"           => "",
                "usk_agent_transform" => "",
                "usk_ip_address"      => "",
                "usk_device"          => "",
                "analyst_status"      => 0,
                "report_status"       => 0,
                "report_meta"         => null,
                "source_created_at"   => $day,
                "created_at"          => now(),
                "updated_at"          => now()
            ];

            $this->__store($dataSubscribe);
        }
    }

    /**
     * __store
     * @param array $dataStore
     * User: Hungokata
     * Date: 2021/06/14 - 11:28
     */
    private function __store($dataStore = [])
    {
        DB::table("subscribe_job_sources")->insert($dataStore);
    }
}

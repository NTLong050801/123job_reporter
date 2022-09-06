<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/15 - 15:40
 */
namespace Workable\SubscribeJob\Console;

use Illuminate\Console\Command;

use Workable\Support\Http\HttpBuilder;

class SubscribeJobApiCommand extends Command
{
    protected $signature = 'subscribe-job:push-api 
                    {--ids= : Report by list id}';

    protected $description = "Push api subscribe job";


    public function __construct()
    {
        parent::__construct();

    }

    public function handle()
    {
        $dateCreate = now()->subDays(20);
        $url        = get_url('reporter', '/api/subscribe-job/store');
        $url        .= '?_debug=true';

        $formParam = [
            "source_id"           => 10000,
            "app_int"             => 1,
            "app_text"            => "123job",
            "usk_meta_loc"        => '{"city":13}',
            "usk_keyword"         => 'tuyển nhân viên kinh doanh',
            "usk_city"            => 'Lâm Đồng',
            "usk_district"        => "",
            "usk_salary"          => 'Trên 50 triệu',
            "usk_email"           => "123job.test@gmail.com",
            "usk_phone"           => "0333383630",
            "usk_source"          => 'sidebar',
            "usk_agent"           => "",
            "usk_agent_transform" => "",
            "usk_ip_address"      => "",
            "usk_device"          => "",
            "analyst_status"      => 0,
            "report_status"       => 0,
            "report_meta"         => null,
            "source_created_at"   => $dateCreate->toDateString(),
        ];
        $http = new HttpBuilder();

        $response = $http->post($url)->formParams($formParam)->call(false, true);

        $dataResponse = $response->getBody()->getContents();
        $dataResponse = json_decode($dataResponse);

        echo_array($dataResponse);
    }
}
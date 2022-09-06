<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/17 - 15:58
 */

namespace Workable\ApplyJob\Console;


use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Workable\Support\Http\HttpBuilder;

class ApplyReportApiCommand extends Command
{
    protected $signature = 'apply-report:push-api';

    protected $description = 'Thực hiện push dữ liệu thông qua api toi apply source';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dateCreate = now()->subDays(20);
        $url        = get_url('reporter', '/api/apply-job/store');
//        $url        .= '?_debug=true';

        $metaData = '{"salary":[{"id":4,"name":"5 - 7 tri\u1ec7u"},{"id":1,"name":"< 1 tri\u1ec7u"}],"city":[{"id":14,"name":"Th\u1eeba Thi\u00ean Hu\u1ebf"},{"id":7,"name":"Long An"}],"district":[],"category":[{"id":53,"name":"\u00d4 t\u00f4 - Xe m\u00e1y"},{"id":87,"name":"Gi\u00e1o d\u1ee5c\/\u0110\u00e0o t\u1ea1o\/Th\u01b0 vi\u1ec7n"}]}';

        $formParam = [
            "apply_type" => Arr::random(['profile', 'cv', 'upload']),
            "source_id" => 1,
            "app_int" => 1,
            "app_text" => "123job",
            "site_name" => 'facebook.com',
            "provider_id" => 1,
            "meta_data" => "",
            "meta_data_transform" => $metaData,
            "meta_agent" => null,
            "meta_agent_transform" => null,
            "source_created_at" => $dateCreate->toDateString(),
        ];

        $http = new HttpBuilder();
        $response = $http->post($url)->formParams($formParam)->call();

        $dataResponse = $response->getBody()->getContents();
        $dataResponse = json_decode($dataResponse);

        echo_array($dataResponse);
    }

}
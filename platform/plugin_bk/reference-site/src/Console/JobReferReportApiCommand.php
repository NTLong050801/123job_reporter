<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/17 - 14:42
 */

namespace Workable\ReferenceSite\Console;


use Illuminate\Console\Command;
use Workable\ReferenceSite\Enum\JobReferEnum;
use Workable\Support\Http\HttpBuilder;

class JobReferReportApiCommand extends Command
{
    protected $signature = 'job-refer-report:push-api';

    protected $description = 'Thực hiện push dữ liệu thông qua api';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $metaData   = '{"salary":[{"id":9,"name":"20 - 25 tri\u1ec7u"},{"id":7,"name":"12 - 15 tri\u1ec7u"}],"city":[{"id":4,"name":"\u0110\u1ed3ng Nai"},{"id":48,"name":"Kon Tum"}],"district":[],"category":[{"id":37,"name":"K\u1ef9 thu\u1eadt \u1ee9ng d\u1ee5ng"},{"id":56,"name":"Promotion Girl\/ Boy (PG-PB)"}]}';
        $dateCreate = now()->subDays(20);
        $url        = get_url('reporter', '/api/reference-site/store');
//        $url        .= '?_debug=true';

        $formParam = [
            "source_id"            => 1,
            'app_int'              => 1,
            'app_text'             => '123job',
            'site_name'            => 'hrvietnam.com',
            'provider_id'          => 0,
            'meta_data'            => '',
            'meta_data_transform'  => $metaData,
            'meta_agent'           => '',
            'meta_agent_transform' => '',
            'analyst_status'       => JobReferEnum::STATUS_ANALYST_INIT,
            'report_status'        => JobReferEnum::STATUS_REPORT_INIT,
            'report_meta'          => null,
            'source_created_at'    => $dateCreate->toDateString()
        ];

        $http = new HttpBuilder();
        $response = $http->post($url)->formParams($formParam)->call();

        $dataResponse = $response->getBody()->getContents();
        $dataResponse = json_decode($dataResponse);

        echo_array($dataResponse);
    }

}
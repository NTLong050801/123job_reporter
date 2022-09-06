<?php

namespace Modules\Monitor\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Report\Repository\MonitorRepository;

class MonitorService
{
    protected $monitorRepository;

    public function __construct()
    {
        $this->monitorRepository = app(MonitorRepository::class);
    }

    public function getList($filter = [])
    {

        return $this->monitorRepository->getList($filter, $paginate = 20);
    }

    public function insert(Request $request)
    {
        $uptimeCheckEnable = $request->has('uptime_check_enabled') ? 1 : 0;
        $certificateCheckEnabled = $request->has('certificate_check_enabled') ? 1 : 0;

        $additional_headers = $request->get('additional_headers');
        $dataInsert = [
            'uptime_check_enabled' => $uptimeCheckEnable,
            'certificate_check_enabled' => $certificateCheckEnabled,
            'additional_headers' => json_encode($additional_headers),
            'payload_rule' => json_encode($request->get('payload_rule')),
        ];


        $dataExcept = $request->except(['_token', 'redirect', 'uptime_check_enabled', 'additional_headers', 'payload_rule', 'certificate_check_enabled']);
        $dataInsert = array_merge($dataInsert, $dataExcept);


        return $this->monitorRepository->insertData($dataInsert);
    }

    public function finById($id)
    {

        return $this->monitorRepository->find($id);
    }

    public function update($request, $id, $data)
    {
        $uptimeCheckEnable = $request->has('uptime_check_enabled') ? 1 : 0;
        $certificateCheckEnabled = $request->has('certificate_check_enabled') ? 1 : 0;

        $additional_headers = $request->get('additional_headers');
        $dataInsert = [
            'uptime_check_enabled' => $uptimeCheckEnable,
            'certificate_check_enabled' => $certificateCheckEnabled,
            'additional_headers' => json_encode($additional_headers),
            'payload_rule' => json_encode($request->get('payload_rule')),
        ];


        $dataExcept = $request->except(['_token', 'redirect', 'uptime_check_enabled', 'additional_headers', 'payload_rule', 'certificate_check_enabled']);
        $dataInsert = array_merge($dataInsert, $dataExcept);

        return $this->monitorRepository->update($id, $dataInsert);

    }

    public function updateApi($monitor, $dataItem, $process, $country)
    {
//        $site_id = DB::table('sites')
//            ->where('country', $country)
//            ->value('id');
//        $monitor = $this->monitorRepository->getMonitorBySite($site_id);

        if ($monitor) {
            $uptime_status = $this->__checkUptimeStatus($monitor, $dataItem['data'], $dataItem['uptime_status']);
            $dataItem = Arr::except($dataItem, ['data']);
            $dataItem['uptime_status'] = $uptime_status;
            $this->monitorRepository->update($monitor->id, $dataItem);
        }

    }

    private function __checkUptimeStatus($monitor, $data, $status_code)
    {
        $response = $monitor['uptime_check_response_checker'];
        $string = $monitor['look_for_string'];
        $uptime_status = '';
        switch ($response) {
            case 'JsonChecker' :
                $uptime_status = $this->__checkJsonChecker($data, $status_code);
                break;
            case 'LookForStringChecker' :
                $uptime_status = $this->__checkLookForStringChecker($data, $status_code, $string);
                break;
            case  'CheckWithPerformance' :
            case 'CheckWithPageSpeed' :
                break;

        }

        return $uptime_status;
    }

    private function __checkJsonChecker($data, $status_code)
    {
        if (json_decode($data) == true && in_array($status_code, self::STATUS_UP)) {
            $uptime_status = 'Up';
        } else {
            $uptime_status = 'Down';
        }

        return $uptime_status;
    }

    private function __checkLookForStringChecker($data, $status_code, $string)
    {
        if (is_string($data) == true && in_array($status_code, self::STATUS_UP) && str_contains($data, $string) == true) {
            $uptime_status = 'Up';
        } else {
            $uptime_status = 'Down';
        }

        return $uptime_status;

    }

    public function delete($id)
    {

        return $this->monitorRepository->delete($id);
    }

    const STATUS_UP = [
        200, 201, 202, 203, 204,
        205, 206, 207, 208, 226
    ];

    const STATUS_DOWN = [
        400, 401, 402, 403, 404,
        405, 500, 501, 502, 503,
        504, 505, 506, 507, 508
    ];


}

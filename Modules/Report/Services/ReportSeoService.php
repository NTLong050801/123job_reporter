<?php

namespace Modules\Report\Services;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\Report\Repository\ReportSeoRepository;

class ReportSeoService
{

    private $reportSeoRepository;

    public function __construct()
    {
        $this->reportSeoRepository = app(ReportSeoRepository::class);
    }

    public function getList($site_id)
    {
        return $this->reportSeoRepository->getList($site_id);

    }

    public function getDataForChart($datas,$day)
    {
        $endDate = Carbon::now()->addDay()->format('Y-m-d');
        $startDate = Carbon::now()->subDays($day)->format('Y-m-d');

        $begin = new DateTime($startDate);
        $end = new DateTime($endDate);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $dataFormat = [];
        foreach ($datas as $data) {
            $date = date('Y-m-d', strtotime($data->time));
            $dataFormat[$date] = [
                date('Y-m-d', strtotime($data->time)),
                $data->address ?? 0,
                $data->category ?? 0,
                $data->title ?? 0,
                $data->company ?? 0,
                $data->work_type ?? 0
            ];
        }

        $dataTrans = [];
        $dataTrans['columns'] = [
            [
                'name' => 'time',
                'type' => 'date',
            ],
            [
                'name' => 'address',
                'type' => 'number',
            ],
            [
                'name' => 'category',
                'type' => 'number'
            ],
            [
                'name' => 'title',
                'type' => 'number'
            ],
            [
                'name' => 'company',
                'type' => 'number'
            ],
            [
                'name' => 'work_type',
                'type' => 'number'
            ]

        ];
        foreach ($period as $dt) {
            $dateFormat = $dt->format('Y-m-d');
            if (isset($dataFormat[$dateFormat])) {
                $dataTrans['rows'][] = $dataFormat[$dateFormat];
            } else {
                $dataTrans['rows'][] =
                    [$dt->format('Y-m-d'), 0,0,0,0,0];
            }
        }

        return $dataTrans;
    }

    public function insertOrUpdateData($country,$items) {
        $site_id = DB::table('sites')
            ->where('country', $country)
            ->value('id');

        foreach ($items as $item) {
            $dateExists = $this->reportSeoRepository->getDate($site_id,$item['date']);
            $data = [
                'address'   => $item['address'],
                'company'   => $item['company'],
                'title'     =>$item['keyword'] ,
                'category'  =>$item['category'],
                'salary'    =>$item['salary'] ?? 0,
                'level'     =>$item['level'] ?? 0,
                'work_type' =>$item['work_type'] ?? 0,
            ];
            if (!$dateExists) {
                $data['time']       = $item['date'];
                $data['site_id']    = $site_id;
                $data['created_at'] = now();
                $data['updated_at'] = now();

                $this->reportSeoRepository->insert($data);
            }
            else {
                $data['updated_at'] = now();

                $this->reportSeoRepository->update($dateExists->id,$data);
            }
        }
    }



}

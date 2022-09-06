<?php

namespace Modules\Report\Services;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Modules\Report\Repository\ReferenceRepository;

class ReferenceService
{
    protected $referenceRepository;

    public function __construct(
        ReferenceRepository $referenceRepository
    )
    {
        $this->referenceRepository = $referenceRepository;
    }

    public function getList($site_id) {

        return $this->referenceRepository->getList($site_id);
    }

    public function getDataForChart($datas,$day)
    {
        $endDate = Carbon::now()->format('Y-m-d');
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
                'name' => 'work type',
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


}

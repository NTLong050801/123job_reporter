<?php

namespace Modules\Report\Services;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Modules\Report\Repository\RobotRepository;

class RobotService
{

    protected $robotRepository;

    public function __construct(
        RobotRepository $repository
    ) {
        $this->robotRepository = $repository;
    }

    public function getList($site_id) {

      return $this->robotRepository->getList($site_id);
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
                $data->google_count ?? 0,
                $data->google_time ?? 0,
                $data->coc_count ?? 0,
                $data->coc_time ?? 0,
            ];
        }

        $dataTrans = [];
        $dataTrans['columns'] = [
            [
                'name' => 'time',
                'type' => 'date',
            ],
            [
                'name' => 'Google count',
                'type' => 'number',
            ],
            [
                'name' => 'Google time',
                'type' => 'number'
            ],
            [
                'name' => 'Coc count',
                'type' => 'number'
            ],
            [
                'name' => 'Coc time',
                'type' => 'number'
            ]

        ];
        foreach ($period as $dt) {
            $dateFormat = $dt->format('Y-m-d');
            if (isset($dataFormat[$dateFormat])) {
                $dataTrans['rows'][] = $dataFormat[$dateFormat];
            } else {
                $dataTrans['rows'][] =
                    [$dt->format('Y-m-d'), 0,0,0,0];
            }
        }

        return $dataTrans;
    }
}

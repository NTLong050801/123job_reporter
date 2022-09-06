<?php

namespace Modules\Report\Services;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\Report\Repository\UploadRepository;

class UploadService
{
    private $uploadRepository;

    public function __construct()
    {
        $this->uploadRepository = app(UploadRepository::class);
    }

    public function getList($site_id)
    {

        return $this->uploadRepository->getList($site_id);
    }

    public function getDataForChart($datas, $day)
    {

        $endDate   = Carbon::now()->addDay()->format('Y-m-d');
        $startDate = Carbon::now()->subDays($day)->format('Y-m-d');

        $begin = new DateTime($startDate);
        $end   = new DateTime($endDate);

        $interval   = DateInterval::createFromDateString('1 day');
        $period     = new DatePeriod($begin, $interval, $end);
        $dataFormat = [];
        foreach ($datas as $data)
        {
            $date              = date('Y-m-d', strtotime($data->time));
            $dataFormat[$date] = [
                date('Y-m-d', strtotime($data->time)),
                $data->count_get ?? 0,
                $data->count_create ?? 0,
                $data->count_update ?? 0,
                $data->count_public ?? 0
            ];
        }

        $dataTrans            = [];
        $dataTrans['columns'] = [
            [
                'name' => 'time',
                'type' => 'date',
            ],
            [
                'name' => 'get',
                'type' => 'number',
            ],
            [
                'name' => 'create',
                'type' => 'number'
            ],
            [
                'name' => 'update',
                'type' => 'number'
            ],
            [
                'name' => 'upload public',
                'type' => 'number'
            ]
        ];

        foreach ($period as $dt)
        {
            $dateFormat = $dt->format('Y-m-d');
            if (isset($dataFormat[$dateFormat]))
            {
                $dataTrans['rows'][] = $dataFormat[$dateFormat];
            }
            else
            {
                $dataTrans['rows'][] =
                    [$dt->format('Y-m-d'), 0, 0, 0, 0];
            }
        }

        return $dataTrans;
    }

    public function insertOrUpdateData($country, $items)
    {

        $site_id = DB::table('sites')
            ->where('country', $country)
            ->value('id');

        foreach ($items as $item)
        {
            $dateExists = $this->uploadRepository->getDate($site_id, $item['date']);
            $data       = [
                'count_get'    => $item['job_sum'],
                'count_create' => $item['job_created'],
                'count_update' => $item['job_updated'],
                'count_public' => $item['job_public'] ?? 0
            ];
            if (!$dateExists)
            {
                $data['time']       = $item['date'];
                $data['site_id']    = $site_id;
                $data['created_at'] = now();
                $data['updated_at'] = now();

                $this->uploadRepository->insert($data);
            }
            else
            {
                $data['updated_at'] = now();

                $this->uploadRepository->update($dateExists->id, $data);
            }
        }

    }


}

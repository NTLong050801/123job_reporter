<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 3:25 PM
 */
namespace Workable\GoogleLog\Services;

use Carbon\Carbon;
use Workable\GoogleLog\Models\GoogleLog;
use Workable\GoogleLog\Repository\GoogleLogRepository;

class GoogleLogService extends GoogleLogBase
{
    private $googleLogRepository;

    public function __construct(GoogleLogRepository $googleLogRepository)
    {
        parent::__construct();

        $this->googleLogRepository = $googleLogRepository;
    }

    public function getList($filterQuery = [])
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->googleLogRepository->getList($filter);
        $results = $this->googleLogReportUtil->transformList($results);

        return $results;
    }

    public function getDataForChart($filterQuery = [])
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->googleLogRepository->getList($filter);

        $dates = [];
        $startDate = Carbon::createFromFormat('Y-m-d', $filter['start_time']);
        $endDate = Carbon::createFromFormat('Y-m-d', $filter['end_time']);
        $diffDay = $startDate->diffInDays($endDate);
        $dates[] = $startDate->format('Y-m-d');
        for($i = 1; $i<= $diffDay; $i ++)
        {
            $dates[] = $startDate->addDay()->format('Y-m-d');
        }

        $results = $this->googleLogReportUtil->transformForChart($results, $dates);

        return $results;
    }

    public function getListForDay($filterQuery =[])
    {
        $filter = $this->__buildFilter($filterQuery);

        $results = $this->googleLogRepository->getListForDay($filter);
        $results = $this->googleLogReportUtil->transformReportDay($results);

        return $results;
    }

    public function getListForMonth($filterQuery =[])
    {
        $filter = $this->__buildFilter($filterQuery);

        $results = $this->googleLogRepository->getListForMonth($filter);
        $results = $this->googleLogReportUtil->transformReportMonth($results);

        return $results;
    }

    private function __buildFilter($filterQuery = [])
    {
        $date       = $filterQuery['date_range'] ?? null;
        $times      = $date ? \FilterHelper::getStartEndTimeVn($date) : null;
        $label_page = $filterQuery['label_page'] ?? null;
        $path       = $filterQuery['path'] ?? null;
        $app_int    = $filterQuery['app_int'] ?? null;
        $order      = $filterQuery['order'] ?? null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        if($label_page) $filter['label_page'] = $label_page;
        if($path) $filter['path'] = $path;
        if($app_int) $filter['app_int'] = $app_int;
        if($order) $filter['order'] = $order;

        return $filter;
    }

    public function updateOrCreate($data)
    {
        $data['updated_at'] = now();
        return GoogleLog::updateOrCreate(
                            [
                                'app_int'           => $data['app_int'],
                                'log_int'           => $data['log_int'],
                                'source_created_at' => $data['source_created_at'],
                                'path'              => $data['path'],
                            ], $data);
    }
}
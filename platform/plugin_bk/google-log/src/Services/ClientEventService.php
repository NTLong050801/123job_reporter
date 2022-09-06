<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 4:19 PM
 */
namespace Workable\GoogleLog\Services;

use Carbon\Carbon;
use Workable\GoogleLog\Models\ClientEvent;
use Workable\GoogleLog\Repository\ClientEventRepository;
use Workable\GoogleLog\Utils\ClientEventReportUtil;

class ClientEventService
{
    protected $clientEventRepository;
    protected $clientEventReportUtil;

    public function __construct(ClientEventRepository $clientEventRepository, ClientEventReportUtil $clientEventReportUtil)
    {
        $this->clientEventRepository = $clientEventRepository;
        $this->clientEventReportUtil = $clientEventReportUtil;
    }

    public function getList($filterQuery = [])
    {
        $filter = $this->__buildFilter($filterQuery);
        $results = $this->clientEventRepository->getList($filter);
        $results = $this->clientEventReportUtil->transformList($results);

        return $results;
    }

    public function getDataForChart($filterQuery = [])
    {
        $filter = $this->__buildFilter($filterQuery);

        $results = $this->clientEventRepository->getList($filter);

        $dates = [];
        $startDate = Carbon::createFromFormat('Y-m-d', $filter['start_time']);
        $endDate = Carbon::createFromFormat('Y-m-d', $filter['end_time']);
        $diffDay = $startDate->diffInDays($endDate);
        $dates[] = $startDate->format('Y-m-d');
        for($i = 1; $i<= $diffDay; $i ++)
        {
            $dates[] = $startDate->addDay()->format('Y-m-d');
        }
        $results = $this->clientEventReportUtil->transformForChart($results, $dates);

        return $results;
    }

    public function getListForDay($filterQuery =[])
    {
        $filter  = $this->__buildFilter($filterQuery);
        $results = $this->clientEventRepository->getListForDay($filter);
        $results = $this->clientEventReportUtil->transformReportDay($results);

        return $results;
    }

    public function getListForMonth($filterQuery =[])
    {
        $filter  = $this->__buildFilter($filterQuery);
        $results = $this->clientEventRepository->getListForMonth($filter);
        $results = $this->clientEventReportUtil->transformReportMonth($results);

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
        return ClientEvent::updateOrCreate(
                            [
                                'app_int'           => $data['app_int'],
                                'event_int'         => $data['event_int'],
                                'source_created_at' => $data['source_created_at'],
                                'path'              => $data['path'],
                            ], $data);
    }
}
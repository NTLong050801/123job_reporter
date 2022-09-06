<?php

namespace Workable\GoogleLog\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GoogleLogRepository
{
    public function getList($filter, $paginate = 0)
    {
        $queryBuilder = $this->__buildFilterQuery($filter);

        return $paginate ? $queryBuilder->paginate($paginate) : $queryBuilder->get();
    }

    public function getListForDay($filter)
    {

        $queryBuilder = $this->__buildFilterQuery($filter, true);

        $queryBuilder->selectRaw("source_created_at, GROUP_CONCAT(CONCAT(log_text, '=', hit) SEPARATOR ',') AS data");
        $queryBuilder->groupBy('source_created_at')->orderBy("source_created_at", 'desc');

        $results = $queryBuilder->get();

        return $results;
    }

    public function getListForMonth($filter)
    {
        $queryBuilder = $this->__buildFilterQuery($filter);

        $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
            ->selectRaw("DATE_FORMAT(`source_created_at`, '%Y-%m') as month_time, 
                                SUM(hit) AS total, 
                                log_text, 
                                COUNT(*) AS total_record")
            ->groupBy(['month_time', 'log_int'])
            ->orderBy("month_time", "desc");

        $results = $queryBuilder->get();

        return $results;
    }

    private function __buildFilterQuery($filter = [], $filterDay = false)
    {
        $startTime  = $filter['start_time'] ?? '';
        $endTime    = $filter['end_time'] ?? '';
        $label_page = $filter['label_page'] ?? '';
        $path       = $filter['path'] ?? '';
        $app_int    = $filter['app_int'] ?? '';
        $order      = $filter['order'] ?? '';

        $queryBuilder = DB::table("google_logs");

        if ($startTime)
        {
            $queryBuilder->whereDate("source_created_at", ">=", $startTime)
                ->whereDate("source_created_at", "<=", $endTime);
        }
        else
        {
            if($filterDay) $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
                ->whereMonth('source_created_at', Carbon::now()->month);
        }
        if($label_page)
            $queryBuilder->where('label_page', $label_page);

        if($path)
            $queryBuilder->where('path', $path);

        if($app_int)
            $queryBuilder->where('app_int', $app_int);
        if($order)
        {
            foreach ($order as $item)
            {
                list($col, $dir) = $item;
                $queryBuilder->orderBy($col, $dir);
            }
        }

        return $queryBuilder;
    }
}
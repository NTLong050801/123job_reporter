<?php

namespace Workable\RobotLog\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RobotCounterRepository
{
    public function getList($filter, $paginate = 0)
    {
        $queryBuilder = $this->__buildFilterQuery($filter);

        return $paginate ? $queryBuilder->paginate($paginate) : $queryBuilder->get();
    }

    private function __buildFilterQuery($filter = [], $filterDay = false)
    {
        $startTime  = $filter['start_time'] ?? '';
        $endTime    = $filter['end_time'] ?? '';
        $label_page = $filter['label_page'] ?? '';
        $path       = $filter['path'] ?? '';
        $bot        = $filter['bot'] ?? '';
        $app_int    = $filter['app_int'] ?? '';
        $order      = $filter['order'] ?? '';

        $queryBuilder = DB::table("robot_counters");

        if ($startTime)
        {
            $queryBuilder->whereDate("date", ">=", $startTime)
                ->whereDate("date", "<=", $endTime);
        }
        else
        {
            if($filterDay) $queryBuilder->whereYear('date', Carbon::now()->year)
                ->whereMonth('date', Carbon::now()->month);
        }
        if($label_page)
            $queryBuilder->where('label_page', $label_page);

        if($path)
            $queryBuilder->where('path', $path);
        if($bot)
            $queryBuilder->where('bot', $bot);

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
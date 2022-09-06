<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/14 - 15:32
 */
namespace Workable\SubscribeJob\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscribeJobSourceRepository
{
    /***
     * listForDay
     * @param array $filter
     * @return \Illuminate\Support\Collection
     * User: Hungokata
     * Date: 2021/06/15 - 14:32
     */
    public function listForDay($filter=[])
    {
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("subscribe_job_sources");

        if ($startTime)
        {
            $queryBuilder->whereDate("source_created_at", ">=", $startTime)
                ->whereDate("source_created_at", "<=", $endTime);
        }else
        {
            $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
                ->whereMonth('source_created_at', Carbon::now()->month);
        }

        $queryBuilder->selectRaw("DATE(source_created_at) AS update_date, COUNT(*) AS total");
        $results = $queryBuilder->groupBy("update_date")->orderBy("update_date", "desc")->get();

         return $results;
    }


    /**
     * listForMonth
     * @param array $filter
     * @return \Illuminate\Support\Collection
     * User: Hungokata
     * Date: 2021/06/15 - 14:32
     */
    public function listForMonth($filter = [])
    {
        $queryBuilder = DB::table("subscribe_job_sources")
                    ->whereYear('source_created_at', Carbon::now()->year)
                    ->selectRaw("DATE_FORMAT(`source_created_at`, '%Y-%m') as month_time, COUNT(*) AS total")
                    ->groupBy("month_time")
                    ->orderBy("month_time", "desc");


        $results = $queryBuilder->get();

        return $results;
    }

    public function store($dataStore)
    {
        return DB::table("subscribe_job_sources")->insert($dataStore);
    }
}
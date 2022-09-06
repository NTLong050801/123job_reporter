<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:52
 */

namespace Workable\ApplyJob\Repository;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplyJobSourceRepository
{
    /**
     * getListForDay
     * @param array $filter
     * @return
     * User: Hungokata
     * Date: 2021/06/10 - 15:52
     */
    public function getListForDay($filter=[])
    {
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("apply_job_sources");

        if ($startTime)
        {
            $queryBuilder->where("source_created_at", ">=", $startTime)
                        ->where("source_created_at", "<=", $endTime);
        }else
        {
            $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
                ->whereMonth('source_created_at', Carbon::now()->month);
        }

        $results =  $queryBuilder->selectRaw("DATE(source_created_at) AS day , COUNT(*) AS total")
                    ->groupBy('day')
                    ->orderBy("source_created_at", 'desc')
                    ->get()
                    ->keyBy("day");

        return $results;
    }

    /**
     * getListForMonth
     * @param array $filter
     * User: Hungokata
     * Date: 2021/06/10 - 15:47
     */
    public function getListForMonth($filter = [])
    {
        $queryBuilder = DB::table("apply_job_sources")
            ->whereYear("source_created_at", Carbon::now()->year)
            ->selectRaw("DATE_FORMAT(`source_created_at`, '%Y-%m') as date_month, COUNT(*) AS total")
            ->groupBy(['date_month'])
            ->orderBy("date_month", 'desc');

        $results = $queryBuilder->get();

        return $results;
    }

    public function store($dataStore)
    {
        return DB::table("apply_job_sources")->insert($dataStore);
    }
}
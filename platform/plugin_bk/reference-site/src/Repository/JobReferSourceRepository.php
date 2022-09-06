<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 15:14
 */
namespace Workable\ReferenceSite\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobReferSourceRepository
{
    /**
     * getListForDay
     * @param array $filter
     * @return \Illuminate\Support\Collection
     * User: Hungokata
     * Date: 2021/06/10 - 15:52
     */
    public function getListForDay($filter=[])
    {
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("job_refer_sources");

        if ($startTime)
        {
            $queryBuilder->where("source_created_at", ">=", $startTime)
                ->where("source_created_at", "<=", $endTime);
        }else
        {
            $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
                ->whereMonth('source_created_at', Carbon::now()->month);
        }

        $queryBuilder->selectRaw("DATE(source_created_at) AS update_date, provider_id, COUNT(*) AS total");
        $queryBuilder->groupBy(['update_date', 'provider_id'])->orderBy("source_created_at", 'desc');

        $results = $queryBuilder->get();

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
        $queryBuilder = DB::table("job_refer_sources")
                            ->whereYear("source_created_at", Carbon::now()->year)
                            ->selectRaw("DATE_FORMAT(`source_created_at`, '%Y-%m') as date_month, provider_id, COUNT(*) AS total")
                            ->groupBy(['date_month', 'provider_id']);

        $results = $queryBuilder->get();

        return $results;
    }

    /**
     * B
     * User: Hungokata
     * Date: 2021/06/17 - 14:30
     */
    public function store($dataStore = [])
    {
        if (!$dataStore) return false;

        DB::table("job_refer_sources")->insert($dataStore);
    }
}
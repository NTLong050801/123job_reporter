<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/15 - 17:47
 */

namespace Workable\SubscribeJob\Repository;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubscribeJobRepository
{
    /**
     * getForDay
     * @param array $filter
     * User: Hungokata
     * Date: 2021/06/15 - 17:47
     */
    public function getForDay($filter = [])
    {
        $attributeType  = $filter['attr_int'] ?? '';
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("subscribe_jobs")
                    ->orderBy("source_created_at", "desc")
                    ->orderBy("hint", "desc")
                    ->select(['attr_text', "source_created_at", 'hint']);

        if ($attributeType)
        {
            $queryBuilder->where("attr_int", $attributeType);
        }

        if ($startTime && $endTime)
        {
            $queryBuilder->whereDate("source_created_at", ">=", $startTime)
                ->whereDate("source_created_at", "<=", $endTime);
        }else
        {
            $queryBuilder->whereYear('source_created_at', Carbon::now()->year)
                ->whereMonth('source_created_at', Carbon::now()->month);
        }

        $results = $queryBuilder->get();

        return $results;
    }

}
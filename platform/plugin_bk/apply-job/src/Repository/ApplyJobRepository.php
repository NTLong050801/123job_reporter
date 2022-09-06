<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:52
 */

namespace Workable\ApplyJob\Repository;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplyJobRepository
{
    public function getListForDay($filter)
    {
        $attributeType  = $filter['attr_int'] ?? null;
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("apply_jobs")
            ->orderBy("source_created_at", "desc")
            ->orderBy("hint", "desc")
            ->select(['attr_text', "source_created_at", 'hint']);

        if ($attributeType !== null)
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
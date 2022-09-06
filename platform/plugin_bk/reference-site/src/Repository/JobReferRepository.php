<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 15:14
 */
namespace Workable\ReferenceSite\Repository;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobReferRepository
{
    public function getListForDay($filter)
    {
        $attributeType  = $filter['attr_int'] ?? \Workable\ReferenceSite\Enum\JobReferEnum::ATTRIBUTE_PROVIDER;
        $startTime      = $filter['start_time'] ?? '';
        $endTime        = $filter['end_time'] ?? '';

        $queryBuilder = DB::table("job_refers")
            ->where("attr_int", $attributeType)
            ->orderBy("source_created_at", "desc")
            ->orderBy("hint", "desc")
            ->select(['attr_text', "source_created_at", 'hint']);

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
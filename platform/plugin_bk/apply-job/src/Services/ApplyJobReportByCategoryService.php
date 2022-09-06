<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:51
 */

namespace Workable\ApplyJob\Services;


use Workable\ApplyJob\Enum\ApplyJobEnum;
use Workable\ApplyJob\Repository\ApplyJobRepository;

class ApplyJobReportByCategoryService extends ApplyJobReportBase
{
    /**
     * @var ApplyJobRepository
     */
    protected $applyJobRepository;

    public function __construct(ApplyJobRepository $applyJobRepository)
    {
        parent::__construct();
        $this->applyJobRepository = $applyJobRepository;
    }

    public function reportByCategory($filterQuery = [])
    {
        $filter  = [
            'attr_int' => ApplyJobEnum::ATTRIBUTE_CATEGORY
        ];

        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        if ($times)
        {
            $filter['start_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['start'])->startOfDay()->toDateTimeString();
            $filter['end_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['end'])->endOfDay()->toDateTimeString();
        }

        $results = $this->applyJobRepository->getListForDay($filter);
        $results = $this->applyReportUtil->transformForDay($results);

        return [
            "times" => $results[0],
            "timeCounts" => $results[1],
            "records" => $results[2]
        ];
    }
}
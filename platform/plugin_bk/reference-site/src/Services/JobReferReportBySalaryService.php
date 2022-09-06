<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/08 - 09:04
 */
namespace Workable\ReferenceSite\Services;

use Workable\ReferenceSite\Enum\JobReferEnum;
use Workable\ReferenceSite\Repository\JobReferRepository;

class JobReferReportBySalaryService extends JobReportReferBase
{
    /**
     * @var JobReferRepository
     */
    protected $jobReferRepository;

    public function __construct(JobReferRepository $jobReferRepository)
    {
        parent::__construct();
        $this->jobReferRepository = $jobReferRepository;
    }

    public function reportByTime($filterQuery  = [])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }
        $filter['attr_int'] = JobReferEnum::ATTRIBUTE_SALARY;

        $results = $this->jobReferRepository->getListForDay($filter);
        $results = $this->referSiteReportUtil->transform($results);

        return [
            "times" => $results[0],
            "timeCounts" => $results[1],
            "records" => $results[2]
        ];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/08 - 09:04
 */
namespace Workable\ReferenceSite\ServicesApi;

use Workable\ReferenceSite\Repository\JobReferSourceRepository;
use Workable\ReferenceSite\Services\JobReportReferBase;

class JobReferServiceApi extends JobReportReferBase
{
    /**
     * @var JobReferSourceRepository
     */
    protected $jobReferResourceRepository;

    public function __construct(JobReferSourceRepository $jobReferResourceRepository)
    {
        parent::__construct();
        $this->jobReferResourceRepository = $jobReferResourceRepository;
    }

    public function list($filterQuery = [])
    {
        $start = microtime(true);

        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }
        else
        {
            $filter['start_time'] = now()->startOfDay()->toDateTimeString();
            $filter['end_time']   = now()->endOfDay()->toDateTimeString();
        }

        $result  = $this->jobReferResourceRepository->getListForDay($filter);
        $result  = $this->referSiteReportUtil->transformItem($result);

        $end     = microtime(true);
        $execute = ($end-$start) * 1000 . 'ms';

        return [
            "result" => $result,
            'query' => $filter,
            "time" => $execute
        ];
    }
}
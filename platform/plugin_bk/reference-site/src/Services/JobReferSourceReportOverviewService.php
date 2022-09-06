<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/08 - 09:04
 */
namespace Workable\ReferenceSite\Services;

use Workable\GoogleLog\Enum\ClientEventEnum;
use Workable\GoogleLog\Enum\GoogleLogEnum;
use Workable\GoogleLog\Services\GoogleLogService;
use Workable\ReferenceSite\Repository\JobReferSourceRepository;

class JobReferSourceReportOverviewService extends JobReportReferBase
{
    /**
     * @var JobReferSourceRepository
     */
    protected $jobReferResourceRepository;
    /**
     * @var GoogleLogService
     */
    protected $googleLogService;

    public function __construct(JobReferSourceRepository $jobReferResourceRepository,
                                GoogleLogService $googleLogService)
    {
        parent::__construct();
        $this->jobReferResourceRepository = $jobReferResourceRepository;
        $this->googleLogService = $googleLogService;
    }

    /**
     * reportByDay
     * @param array $filterQuery
     * @return array
     * User: Hungokata
     * Date: 2021/06/10 - 15:11
     */
    public function reportByDay($filterQuery =[])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        $results    = $this->jobReferResourceRepository->getListForDay($filter);

        $filterQuery['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filterQuery['path']       = '/viec-lam/';
        $filterQuery['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForDay($filterQuery);

        $results    = $this->referSiteReportUtil->transformTableSource($results, $visitItems);

        return [
            "headingInfo" => $results[0],
            "items" => $results[1],
            "footerArr" => $results[2],
        ];
    }


    /**
     * reportByMonth
     * @param array $filterQuery
     * User: Hungokata
     * Date: 2021/06/10 - 15:47
     */
    public function reportByMonth($filterQuery = [])
    {
        $results = $this->jobReferResourceRepository->getListForMonth();

        $filterQuery['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filterQuery['path']       = '/viec-lam/';
        $filterQuery['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForMonth($filterQuery);

        $results = $this->referSiteReportUtil->transformReportMonth($results, $visitItems);

        return [
            "headingInfo" => $results[0],
            "items" => $results[1],
            "footerArr" => $results[2],
        ];
    }
}
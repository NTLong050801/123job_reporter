<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:51
 */

namespace Workable\ApplyJob\Services;


use Workable\ApplyJob\Repository\ApplyJobSourceRepository;
use Workable\ApplyJob\Utils\ApplyReportMonthUtil;
use Workable\ApplyJob\Utils\ApplyReportUtil;
use Workable\GoogleLog\Enum\ClientEventEnum;
use Workable\GoogleLog\Enum\GoogleLogEnum;
use Workable\GoogleLog\Services\ClientEventService;
use Workable\GoogleLog\Services\GoogleLogService;

class ApplyJobSourceService
{
    /**
     * @var ApplyJobSourceRepository
     */
    protected $applyJobSourceRepository;

    /**
     * @var ApplyReportUtil
     */
    protected $applyReportUtil;

    /**
     * @var ApplyReportMonthUtil
     */
    protected $applyReportMonthUtil;

    /**
     * @var GoogleLogService
     */
    protected $googleLogService;
    /**
     * @var ClientEventService
     */
    protected $clientEventService;

    public function __construct(ApplyJobSourceRepository $applyJobRepository,
                                GoogleLogService $googleLogService,
                                ClientEventService $clientEventService)
    {
        $this->applyJobSourceRepository = $applyJobRepository;
        $this->applyReportUtil          = new ApplyReportUtil();
        $this->applyReportMonthUtil     = new ApplyReportMonthUtil();
        $this->googleLogService         = $googleLogService;
        $this->clientEventService       = $clientEventService;
    }

    public function overview($filterQuery = [])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['start'])->startOfDay()->toDateTimeString();
            $filter['end_time'] = \Carbon\Carbon::createFromFormat('Y-m-d', $times['end'])->endOfDay()->toDateTimeString();
        }


        $items      = $this->applyJobSourceRepository->getListForDay($filter);

        $filterQuery['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filterQuery['path']       = '/viec-lam/';
        $filterQuery['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForDay($filterQuery);

        $filterQuery['label_page'] = ClientEventEnum::LABEL_PAGE_JOB;
        $filterQuery['path']       = '/viec-lam/';
        $filterQuery['app_int']    = ClientEventEnum::APP_123JOB;
        $clickItems = $this->clientEventService->getListForDay($filterQuery);

        $items      = $this->applyReportUtil->transformForOverview($items, $visitItems, $clickItems);

        return [
            'userActivityCount' => $items[0],
            "items" => $items[1],
        ];
    }

    /**
     * overviewMonth
     * @return array
     * User: Hungokata
     * Date: 2021/06/13 - 12:15
     */
    public function overviewMonth()
    {
        $filter = [];
        $items  = $this->applyJobSourceRepository->getListForMonth($filter);

        $filter['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filter['path']       = '/viec-lam/';
        $filter['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForMonth($filter);

        $filter['label_page'] = ClientEventEnum::LABEL_PAGE_JOB;
        $filter['path']       = '/viec-lam/';
        $filter['app_int']    = ClientEventEnum::APP_123JOB;
        $clickItems = $this->clientEventService->getListForMonth($filter);

        $items  = $this->applyReportMonthUtil->transformByMonth($items, $visitItems, $clickItems);
        return [
            'userActivityCount' => $items[0],
            "items" => $items[1]
        ];
    }

    /**
     * store
     * @param array $dataInput
     * User: Hungokata
     * Date: 2021/06/17 - 16:31
     */
    public function store($dataInput = [])
    {
        $dataStore = [
            "apply_type"           => $dataInput['apply_type'],
            "source_id"            => $dataInput['source_id'],
            'app_int'              => $dataInput['app_int'] ?? 1,
            'app_text'             => $dataInput['app_text'] ?? '123job',
            "site_name"            => $dataInput['site_name'],
            "provider_id"          => $dataInput['provider_id'],
            "meta_data"            => $dataInput['meta_data'],
            "meta_data_transform"  => $dataInput['meta_data_transform'] ?? null,
            "meta_agent"           => $dataInput['meta_agent'] ?? null,
            "meta_agent_transform" => $dataInput['meta_agent_transform'] ?? null,
            "source_created_at"    => $dataInput['source_created_at'],
            "created_at"           => now(),
            "updated_at"           => now(),
        ];
        return $this->applyJobSourceRepository->store($dataStore);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/14 - 15:22
 */
namespace Workable\SubscribeJob\Services;

use Workable\GoogleLog\Enum\ClientEventEnum;
use Workable\GoogleLog\Enum\GoogleLogEnum;
use Workable\GoogleLog\Services\ClientEventService;
use Workable\GoogleLog\Services\GoogleLogService;
use Workable\SubscribeJob\Repository\SubscribeJobSourceRepository;
use Workable\SubscribeJob\Utils\SubscribeJobSourceUtil;

class SubscribeJobSourceService
{
    /**
     * @var SubscribeJobSourceUtil
     */
    protected $subscribeJobUtil;

    /**
     * @var SubscribeJobSourceRepository
     */
    protected $subscribeJobSourceRepository;
    /**
     * @var GoogleLogService
     */
    protected $googleLogService;
    /**
     * @var ClientEventService
     */
    protected $clientEventService;

    public function __construct(SubscribeJobSourceRepository $subscribeJobSourceRepository,
                                GoogleLogService $googleLogService,
                                ClientEventService $clientEventService)
    {
        $this->subscribeJobUtil             = new SubscribeJobSourceUtil();
        $this->subscribeJobSourceRepository = $subscribeJobSourceRepository;
        $this->googleLogService             = $googleLogService;
        $this->clientEventService       = $clientEventService;
    }

    /**
     * reportOverview
     * @param array $filter
     * User: Hungokata
     * Date: 2021/06/14 - 15:31
     */
    public function reportOverview($filterQuery = [])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        $results    = $this->subscribeJobSourceRepository->listForDay($filter);

        // GA
        $filterQuery['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filterQuery['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForDay($filterQuery);

        // Event
        $filterQuery['label_page'] = ClientEventEnum::LABEL_PAGE_JOB;
        $filterQuery['app_int']    = ClientEventEnum::APP_123JOB;
        $clickItems = $this->clientEventService->getListForDay($filterQuery);

        $results    = $this->subscribeJobUtil->transformForDay($results, $visitItems, $clickItems);

        return [
            "headingInfo" => $results[0],
            "itemDateArr" => $results[1],
            "footerArr"   => $results[2]
        ];
    }

    /**
     * reportMonth
     * @param array $filter
     * User: Hungokata
     * Date: 2021/06/14 - 15:31
     */
    public function reportMonth($filter = [])
    {
        $results = $this->subscribeJobSourceRepository->listForMonth($filter);

        $filter['label_page'] = GoogleLogEnum::LABEL_PAGE_JOB;
        $filter['app_int']    = GoogleLogEnum::APP_123JOB;
        $visitItems = $this->googleLogService->getListForMonth($filter);

        $filter['label_page'] = ClientEventEnum::LABEL_PAGE_JOB;
        $filter['app_int']    = ClientEventEnum::APP_123JOB;
        $clickItems = $this->clientEventService->getListForMonth($filter);

        $results = $this->subscribeJobUtil->transformForMonth($results, $visitItems, $clickItems);

        return [
            "headingInfo" => $results[0],
            "itemMonthArr" => $results[1],
            "footerArr" => $results[2],
        ];
    }
    
    /**
     * store
     * @param array $dataInput
     * User: Hungokata
     * Date: 2021/06/17 - 17:02
     */
    public function store($dataInput = [])
    {
        $dataStore = [
            "source_id"           => $dataInput['source_id'],
            "app_int"             => $dataInput['app_int'] ?? 1,
            "app_text"            => $dataInput['app_text'] ?? '123job',
            "usk_meta_loc"        => $dataInput['usk_meta_loc'] ?? null,
            "usk_keyword"         => $dataInput['usk_keyword'] ?? null,
            "usk_city"            => $dataInput['usk_city'] ?? null,
            "usk_district"        => $dataInput['usk_district'] ?? null,
            "usk_salary"          => $dataInput['usk_salary'] ?? null,
            "usk_email"           => $dataInput['usk_email'] ?? null,
            "usk_phone"           => $dataInput['usk_phone'] ?? null,
            "usk_source"          => $dataInput['usk_source'],
            "usk_agent"           => $dataInput['usk_agent'] ?? null,
            "usk_agent_transform" => $dataInput['usk_agent_transform'] ?? null,
            "usk_ip_address"      => $dataInput['usk_ip_address'] ?? null,
            "usk_device"          => $dataInput['usk_device'] ?? null,
            "source_created_at"   => $dataInput['source_created_at'],
            "created_at"          => now(),
            "updated_at"          => now()
        ];

        return $this->subscribeJobSourceRepository->store($dataStore);
    }
}
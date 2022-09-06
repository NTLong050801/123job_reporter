<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/14 - 15:22
 */
namespace Workable\SubscribeJob\Services;

use Workable\SubscribeJob\Enum\SubscribeJobEnum;
use Workable\SubscribeJob\Repository\SubscribeJobRepository;
use Workable\SubscribeJob\Utils\SubscribeJobUtil;

class SubscribeJobService
{
    /**
     * @var SubscribeJobUtil
     */
    protected $subscribeJobUtil;

    /**
     * @var subscribeJobRepository
     */
    protected $subscribeJobRepository;

    public function __construct(SubscribeJobRepository $subscribeJobRepository)
    {
        $this->subscribeJobUtil = new SubscribeJobUtil();

        $this->subscribeJobRepository = $subscribeJobRepository;
    }

    public function reportByLocation($filterQuery =[])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        $filter['attr_int'] = SubscribeJobEnum::ATTRIBUTE_CITY;

        $results = $this->subscribeJobRepository->getForDay($filter);
        $results = $this->subscribeJobUtil->transform($results);

        return [
            "headingInfo" => $results[0],
            "footerArr" => $results[1],
            "items" => $results[2],
        ];
    }

    public function reportBySalary($filterQuery =[])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        $filter['attr_int'] = SubscribeJobEnum::ATTRIBUTE_SALARY;

        $results = $this->subscribeJobRepository->getForDay($filter);
        $results = $this->subscribeJobUtil->transform($results);

        return [
            "headingInfo" => $results[0],
            "footerArr" => $results[1],
            "items" => $results[2],
        ];
    }

    public function reportBySource($filterQuery =[])
    {
        $date    = $filterQuery['date_range'] ?? null;
        $times   = $date ? \FilterHelper::getStartEndTimeVn($date) : null;

        $filter = [];
        if ($times)
        {
            $filter['start_time'] = $times['start'];
            $filter['end_time'] = $times['end'];
        }

        $filter['attr_int'] = SubscribeJobEnum::ATTRIBUTE_SOURCE;

        $results = $this->subscribeJobRepository->getForDay($filter);
        $results = $this->subscribeJobUtil->transform($results);

        return [
            "headingInfo" => $results[0],
            "footerArr" => $results[1],
            "items" => $results[2],
        ];
    }

    public function reportAttr()
    {

    }

}
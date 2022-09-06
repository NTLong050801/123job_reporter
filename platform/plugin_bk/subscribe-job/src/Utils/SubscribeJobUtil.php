<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/16 - 10:17
 */

namespace Workable\SubscribeJob\Utils;


class SubscribeJobUtil
{
    /**
     * transform
     * @param $items
     * @return array
     * User: Hungokata
     * Date: 2021/06/10 - 16:04
     */
    public function transform($items)
    {
        $times      = [];
        $timeCount  = [];
        $websites   = [];

        foreach ($items as $item)
        {
            $times[date('d/m', strtotime($item->source_created_at))] = $item->source_created_at;
            $dateCount = $timeCount[$item->source_created_at] ?? 0;
            $timeCount[$item->source_created_at] = $dateCount + $item->hint;

            $websites[$item->attr_text][$item->source_created_at] = $item->hint;
        }

        $websiteTransform = [];
        if ($websites)
        {
            foreach ($websites as $key => $timeItem)
            {
                $timeValue = [];
                $totalTimes = 0;
                foreach ($times as $time)
                {
                    $valueTime = $timeItem[$time] ?? 0;
                    $timeValue[$time] = $valueTime;
                    $totalTimes += $valueTime;
                }

                $websiteTransform[$key]['count'] = $timeValue;
                $websiteTransform[$key]['total'] = $totalTimes;
            }
        }

        $times = array_keys($times);
        array_multisort(array_column($websiteTransform, 'total'), SORT_DESC, $websiteTransform);

        return [
            $times,
            $timeCount,
            $websiteTransform
        ];
    }

}
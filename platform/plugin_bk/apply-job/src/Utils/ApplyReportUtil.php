<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 23:35
 */
namespace Workable\ApplyJob\Utils;

use Carbon\CarbonPeriod;

class ApplyReportUtil
{

    public function transformItems($items, $filter)
    {
        $startTime = $filter['start_time'];
        $endTime   = $filter['end_time'];
        $period    = CarbonPeriod::create(date('Y-m-d', strtotime($startTime)), date('Y-m-d', strtotime($endTime)));
        $period    = array_reverse($period->toArray());

        $dataRtn   = [];
        foreach ($period as $date)
        {
            $date = $date->format('Y-m-d');
            $dateFormat = date('d/m/Y', strtotime($date));

            $dataRtn[] = [
                "date" => $dateFormat,
                "total" => $items[$date]->total ?? 0
            ];
        }
        return $dataRtn;
    }

    public function transformForOverview($items, $visitItems = [], $clickItems = [])
    {
        $dataRtn = [];

        $settingVisitor = [
            "ga_user" => 0,
            "ga_session" => 0,
            "ga_page_view" => 0,
            "ga_bounce_rate" => 0,
        ];

        $settingClick = [
            "click_open_apply" => 0,
//            "click_refer" => ""
        ];

        // Mảng chứa giá trị count
        $settingDataCount = array_merge($settingVisitor, $settingClick);
        $totalCount = 0;

        foreach ($items as $item)
        {
            $dateValue = $item->day;

            $dataSetting = $settingVisitor;
            $dataClick = $settingClick;

            $visitItemDate     = $visitItems[$dateValue] ?? [];
            $clickApplyDate    = $clickItems[$dateValue] ?? [];

            if($settingVisitor && $visitItemDate)
            {
                foreach ($settingVisitor as $keyVisitor => $visitorItem)
                {
                    $countVisitor = $visitItemDate[$keyVisitor] ?? 0;
                    $dataSetting[$keyVisitor] = $countVisitor;
                    $settingDataCount[$keyVisitor] +=  $countVisitor;
                }
            }

            if ($settingClick )
            {
                foreach ($settingClick as $keyClick => $clickItem)
                {
                    $countClick                 = $clickApplyDate[$keyClick] ?? 0;
                    $dataClick[$keyClick]       = $countClick;
                    $settingDataCount[$keyClick] +=  $countClick;
                }
            }

            $total = $item->total;
            $visitor = array_merge($dataSetting, $dataClick);

            if ($visitor['click_open_apply'])
            {
                $avg = ($total/$visitor['click_open_apply']);
                $avg = $avg*100;
                $avg = number_format($avg, 2);
            }
            else
            {
                $avg = 0;
            }

            $dataRtn[$dateValue] = [
                "visitor" => $visitor,
                "count" => $item->total,
                "avg" => $avg ?? 0
            ];
            $totalCount += $item->total;
        }

        $settingDataCount['sumApply'] = $totalCount;
        $settingDataCount['avgApply'] = 0;
        if ($settingDataCount['click_open_apply'])
        {
            $avgApply = $settingDataCount['sumApply']/$settingDataCount['click_open_apply'];
            $avgApply = $avgApply*100;
            $avgApply = number_format($avgApply, 2);

            $settingDataCount['avgApply'] = $avgApply . ' %';
        }

        return [
            $settingDataCount,
            $dataRtn
        ];
    }

    public function transformForDay($results)
    {
        $times      = [];
        $timeCount  = [];
        $items = [];
        $itemTransform = [];
        foreach ($results as $item)
        {
            $times[date('d/m', strtotime($item->source_created_at))] = $item->source_created_at;
            $dateCount = $timeCount[$item->source_created_at] ?? 0;
            $timeCount[$item->source_created_at] = $dateCount + $item->hint;

            $items[$item->attr_text][$item->source_created_at] = $item->hint;
        }

        if ($items)
        {
            foreach ($items as $keyName => $timeItems)
            {
                $timeValue = [];
                $totalTimes = 0;
                foreach ($times as $time)
                {
                    $valueTime = $timeItems[$time] ?? 0;
                    $timeValue[$time] = $valueTime;
                    $totalTimes += $valueTime;
                }

                $itemTransform[$keyName]['count'] = $timeValue;
                $itemTransform[$keyName]['total'] = $totalTimes;
            }
        }

        $times = array_keys($times);
        array_multisort(array_column($itemTransform, 'total'), SORT_DESC, $itemTransform);

        return [
            $times,
            $timeCount,
            $itemTransform
        ];
    }
}
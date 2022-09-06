<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 16:03
 */
namespace Workable\ReferenceSite\Utils;

use Workable\ReferenceSite\Enum\JobReferEnum;

class ReferSiteReportUtil
{
    public function transformItem($items)
    {
        if (empty($items)) return [];
        $dayArr           = []; // Số lượng ngày
        foreach ($items as $item)
        {
            $sourceKey    = JobReferEnum::PROVIDER_ARRAY_TEXT[$item->provider_id];
            $date         = date('d/m/Y', strtotime($item->update_date));

            $dayArr[$date]["Date"] = $date;
            $dayArr[$date][$sourceKey] = $item->total;
        }

        $dayArr = array_values($dayArr);

        return $dayArr;
    }

    public function transformTableSource($items, $visitItems = [])
    {
        $providerArr      = []; // Danh sách provider
        $providerCountArr = []; // Số lượng provider with value tổng
        $dayArr           = []; // Số lượng ngày
        $listItems          = [];

        foreach ($items as $item)
        {
            $providerArr[$item->provider_id] = $item->provider_id;
            $providerCount = $providerCountArr[$item->provider_id] ?? 0;
            $providerCountArr[$item->provider_id] = $providerCount + $item->total;
            $dayArr[$item->update_date][$item->provider_id] = $item->total;
        }

        $settingVisitor = [
            "ga_user" => 0,
            "ga_session" => 0,
            "ga_page_view" => 0,
            "ga_bounce_rate" => 0,
        ];

        $headingInfo = [
            "ga_user" => "GA-User [1]",
            "ga_session" => "GA-Session [2]",
            "ga_page_view" => "GA-Page view [3]",
            "ga_bounce_rate" => "GA-Bounce rate [4]",
        ];

        $footerArr = $settingVisitor;

        if ($dayArr)
        {
            foreach ($dayArr as $dateValue => $dayItem)
            {
                $totalTimes = 0;
                $dayValue   = [];
                $providerValueArr = [];

                $dataSetting       = $settingVisitor;
                $visitItemDate     = $visitItems[$dateValue] ?? [];

                // Tính data visitor
                if($settingVisitor && $visitItemDate)
                {
                    foreach ($settingVisitor as $keyVisitor => $visitorItem)
                    {
                        $countVisitor = $visitItemDate[$keyVisitor] ?? 0;
                        $dataSetting[$keyVisitor] = $countVisitor;
                        $footerArr[$keyVisitor] += $countVisitor;
                    }
                }

                // Tính data source
                foreach ($providerArr as $productValue)
                {
                    $valueTime = $dayItem[$productValue] ?? 0;
                    $providerValueArr[$productValue] = [
                        "count" => $valueTime
                    ];
                    $totalTimes += $valueTime;
                    $dayValue[$productValue] = $valueTime;
                }

                // Tính avg
                foreach ($providerValueArr as &$providerValueItem)
                {
                    $percent = $providerValueItem['count']/$totalTimes;
                    $percent = $percent*100;
                    $percent = number_format($percent, 2);
                    $providerValueItem['percent'] = $percent;
                }

                // Assign
                $listItems[$dateValue] = [
                    "visitor"  => $dataSetting,
                    "provider" => $providerValueArr,
                    "total"    =>  $totalTimes
                ];
            }
        }

        foreach ($providerArr as $providerInt)
        {
            $headingInfo[$providerInt] = JobReferEnum::PROVIDER_ARRAY_TEXT[$providerInt];
        }

        // Tính footer
        $totalProvider = 0;
        $sumTotal = array_sum($providerCountArr);
        $dataFooterAppend = [];
        foreach ($providerCountArr as $key => $providerCount)
        {
            $percent = $providerCount/$sumTotal;
            $percent = $percent*100;
            $percent = number_format($percent, 2);
            $dataFooterAppend[JobReferEnum::PROVIDER_ARRAY_TEXT[$key]] = [
                'count' => $providerCount,
                'percent' => $percent
            ];
            $totalProvider += $providerCount;
        }

        $footerArr = array_merge($footerArr, $dataFooterAppend);
        $footerArr['total'] = $totalProvider;


        return [
            $headingInfo,
            $listItems,
            $footerArr
        ];
    }

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

    public function transformReportMonth($results=[], $visitItems = [])
    {
        if (!$results) return null;

        $settingVisitor = [
            "ga_user" => 0,
            "ga_session" => 0,
            "ga_page_view" => 0,
            "ga_bounce_rate" => 0,
        ];

        $headingInfo = [
            "ga_user" => "GA-User [1]",
            "ga_session" => "GA-Session [2]",
            "ga_page_view" => "GA-Page view [3]",
            "ga_bounce_rate" => "GA-Bounce rate [4]",
        ];

        $listItems = [];

        $provider = [];
        $dataMonthArr = [];
        $providerCountArr = [];

        // Lấy danh sách provider
        foreach ($results as $resultItem)
        {
            $provider[$resultItem->provider_id] = $resultItem->provider_id;

            $providerCount = $providerCountArr[$resultItem->provider_id] ?? 0;
            $providerCountArr[$resultItem->provider_id] = $providerCount + $resultItem->total;

            $dataMonthArr[$resultItem->date_month][$resultItem->provider_id] = $resultItem->total;
        }

        // Transform
        if ($dataMonthArr)
        {
            foreach ($dataMonthArr as $monthYear => $dataMonthItem)
            {
                $totalTimes = 0;
                $providerValueArr = [];

                // Visitor
                $visitor = [];
                foreach ($settingVisitor as $key => $value)
                {
                    $val = $visitItems[$monthYear][$key] ?? 0;
                    $visitor[$key] = $val;
                    $settingVisitor[$key] += $val;
                }

                // Get value provider ...
                foreach ($provider as $providerInt)
                {
                    $totalTimes += $dataMonthItem[$providerInt];
                    $valueProvider = $dataMonthItem[$providerInt];
                    $providerValueArr[$providerInt] = [
                        "count" => $valueProvider
                    ];
                }

                // Tính avg
                foreach ($providerValueArr as &$providerValueItem)
                {
                    $percent = $providerValueItem['count']/$totalTimes;
                    $percent = $percent*100;
                    $percent = number_format($percent, 2);
                    $providerValueItem['percent'] = $percent;
                }

                // Append
                $listItems[$monthYear] = [
                    "visitor"  => $visitor,
                    "provider" => $providerValueArr,
                    "total"    =>  $totalTimes
                ];
            }
        }

        // Heading info
        foreach ($provider as $providerInt)
        {
            $headingInfo[$providerInt] = JobReferEnum::PROVIDER_ARRAY_TEXT[$providerInt];
        }

        // Tính footer
        $totalProvider    = 0;
        $dataFooterAppend = [];
        $sumTotal         = array_sum($providerCountArr);

        foreach ($providerCountArr as $key => $providerCount)
        {
            $percent = $providerCount/$sumTotal;
            $percent = $percent*100;
            $percent = number_format($percent, 2);
            $dataFooterAppend[JobReferEnum::PROVIDER_ARRAY_TEXT[$key]] = [
                'count' => $providerCount,
                'percent' => $percent
            ];
            $totalProvider += $providerCount;
        }

        $settingVisitor['ga_bounce_rate'] = round($settingVisitor['ga_bounce_rate'] / count($dataMonthArr), 2);
        $footerArr                        = array_merge($settingVisitor, $dataFooterAppend);
        $footerArr['total']               = $totalProvider;

        return [
            $headingInfo,
            $listItems,
            $footerArr
        ];
    }

}
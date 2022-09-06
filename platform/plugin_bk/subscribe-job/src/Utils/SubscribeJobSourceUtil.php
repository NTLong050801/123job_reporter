<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/14 - 15:23
 */

namespace Workable\SubscribeJob\Utils;

class SubscribeJobSourceUtil
{
    public function transformForDay($listItems=[], $visitItems=[], $clickItems=[])
    {
        $settingVisitor = [
            "ga_user" => 0,
            "ga_session" => 0,
        ];

        $settingClick = [
            "click_subscribe_job" => 0,
            "open_subscribe_job" => 0,
        ];

        $headingInfo = [
            "ga_user" => "GA-User <br> [1]",
            "ga_session" => "GA-Session <br> [2]",
        ];

        $headingInfo['subscribe_click']    = "Click-subscribe <br> [3]";
        $headingInfo['subscribe_open']    = "Open-subscribe <br> [4]";
        $headingInfo['subscribe_success'] = "Subscribe succeed <br> [5]";
        $headingInfo['subscribe_percent'] = "Subscribe percent (%) <br> [5/4]";

        $dateArr     = [];
        $itemDateArr = [];
        $sumDate     = 0;
        $footerArr   = array_merge($settingVisitor, $settingClick);

        foreach ($listItems as $itemDay)
        {

            $date = $itemDay->update_date;
            $dateArr[$date] = $date;
            $sumDate += $itemDay->total;

            // Get visitor
            $visitorDate = $settingVisitor;
            $clickDate   = $settingClick;

            $visitors = $visitItems[$date] ?? [];
            foreach ($settingVisitor as $keyVisitor => $visitorItem)
            {
                $countVisitor = $visitors[$keyVisitor] ?? 0;
                $visitorDate[$keyVisitor] = $countVisitor;
                $footerArr[$keyVisitor] += $countVisitor;
            }


            // Get click
            $visitorClick = $clickItems[$date] ?? [];
            foreach ($settingClick as $keyClick => $clickValue)
            {
                $countClick = $visitorClick[$keyClick] ?? 0;

                $footerArr[$keyClick] += $countClick;
                $clickDate[$keyClick] = $countClick;
            }

            $visitorDate =  array_merge($visitorDate, $clickDate);
            $visitorDate['subscribe_success'] = $itemDay->total;

            // Tính percent
            $percentDate = 0;
            if ($visitorDate['open_subscribe_job'])
            {
                $percentDate = ($itemDay->total/$visitorDate['open_subscribe_job']);
                $percentDate = $percentDate*100;
                $percentDate = number_format($percentDate, 2);
            }

            $itemDateArr[$date] =  [
                "visitor" => $visitorDate,
                "percent" => $percentDate ?? 0,
                "total" => $itemDay->total
            ];
        }



        $percentApply = 0;
        if ($footerArr['open_subscribe_job'])
        {
            $percentApply = $sumDate/$footerArr['open_subscribe_job'];
            $percentApply = $percentApply*100;
            $percentApply = number_format($percentApply, 2);
            $percentApply .= ' %';
        }

        $footerArr['sum_total'] = $sumDate;
        $footerArr['percent_apply'] = $percentApply;

        return [
            $headingInfo ?? [],
            $itemDateArr ?? [],
            $footerArr ?? []
        ];
    }


    /**
     * transformForMonth
     * @param $listItem
     * @param array $visitItems
     * @param array $clickItems
     * User: Hungokata
     * Date: 2021/06/15 - 14:26
     * @return array
     */
    public function transformForMonth($listItems, $visitItems=[], $clickItems=[])
    {

        $settingVisitor = [
            "ga_user" => 0,
            "ga_session" => 0,
        ];

        $settingClick = [
            "click_subscribe_job" => 0,
            "open_subscribe_job" => 0,
        ];

        $headingInfo = [
            "ga_user" => "GA-User <br> [1]",
            "ga_session" => "GA-Session <br> [2]",
        ];

        $headingInfo['subscribe_click']    = "Click-subscribe <br> [3]";
        $headingInfo['subscribe_open']    = "Open-subscribe <br> [4]";
        $headingInfo['subscribe_success'] = "Subscribe succeed <br> [5]";
        $headingInfo['subscribe_percent'] = "Subscribe percent (%) <br> [5/4]";

        $itemDateArr = [];
        $footerArr   = array_merge($settingVisitor, $settingClick);

        $sumMonth = 0;
        foreach ($listItems as  $itemMonth)
        {
            $date = $itemMonth->month_time;
            $sumMonth += $itemMonth->total;

            $visitorMonth = $settingVisitor;
            $clickMonth  = $settingClick;

            // lấy value visitor from ga
            $visitItem = $visitItems[$date] ?? [];
            if ($visitItem)
            {
                foreach ($settingVisitor as $keyVisitor => $visitorItem)
                {
                    $countVisitor = $visitItem[$keyVisitor] ?? 0;
                    $visitorMonth[$keyVisitor] = $countVisitor;
                    $footerArr[$keyVisitor] += $countVisitor;
                }
            }

            // Get click
            $visitorClick = $clickItems[$date] ?? [];
            if ($visitorClick)
            {
                foreach ($settingClick as $keyClick => $clickValue)
                {
                    $countClick = $visitorClick[$keyClick] ?? 0;
                    $clickMonth[$keyClick] = $countClick;
                    $footerArr[$keyClick] += $countClick;
                }
            }

            $visitor = array_merge($visitorMonth, $clickMonth);
            $visitor['subscribe_success'] = $itemMonth->total;

            $percentMonth = 0;
            if ($visitor['open_subscribe_job'])
            {
                $percentMonth = ($itemMonth->total/$visitor['open_subscribe_job']);
                $percentMonth = $percentMonth*100;
                $percentMonth = number_format($percentMonth, 2);
            }

            $itemDateArr[$date] = [
                "visitor" => $visitor,
                "percent" => $percentMonth,
                'total' => $itemMonth->total
            ];
        }


        $percent = 0;
        if ($footerArr['open_subscribe_job'])
        {
            $percent = $footerArr['open_subscribe_job']/$footerArr['click_subscribe_job'];
            $percent = $percent * 100;
            $percent = number_format($percent, 2);
        }

        $footerArr['sumMonth'] = $sumMonth;
        $footerArr['percent']  = $percent . ' %';

        return [
            $headingInfo ?? [],
            $itemDateArr ?? [],
            $footerArr ?? []
        ];
    }
}
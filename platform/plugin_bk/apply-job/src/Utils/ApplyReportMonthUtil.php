<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/10 - 23:35
 */
namespace Workable\ApplyJob\Utils;

class ApplyReportMonthUtil
{
    public function transformByMonth($items, $visitItems = [], $clickItems = [])
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
        ];

        $sumApply       = 0;
        $avgApply       = 0;

        // Item
        foreach ($items as $item)
        {
            $visitMonth = $visitItems[$item->date_month] ?? [];
            $dataSetting = [];
            foreach ($settingVisitor as $key => $value)
            {
                $val                  = $visitMonth[$key] ?? 0;
                $settingVisitor[$key] += $val;
                $dataSetting[$key]    = $val;
            }
            $clickApply = $clickItems[$item->date_month]['click_open_apply'] ?? 0;
            $dataClick = [
                "click_open_apply" => $clickApply,
            ];
            $settingClick['click_open_apply'] += $clickApply;

            $visitor = array_merge($dataSetting, $dataClick);

            $dataRtn[$item->date_month]['count'] = $item->total;
            $dataRtn[$item->date_month]['visitor'] = $visitor;
            $dataRtn[$item->date_month]['avg'] = $clickApply ? round($item->total / $clickApply * 100, 2) : 0;

            $sumApply += $item->total;
        }

        // Tổng
        $settingDataCount = array_merge($settingVisitor, $settingClick);
        $settingDataCount['sumApply'] = $sumApply;


        if ($totalOpenApply = $settingDataCount['click_open_apply'])
        {
            $avgApply = $sumApply/$totalOpenApply;
            $avgApply = ($avgApply * 100);
            $avgApply = number_format($avgApply, 2) . ' %';
        }

        $settingDataCount['avgApply'] = $avgApply;
        $settingDataCount['ga_bounce_rate'] = round($settingDataCount['ga_bounce_rate'] / count($items), 2);

        return [
            $settingDataCount,
            $dataRtn
        ];
    }
}
<?php
namespace Workable\RobotLog\Utils;

class RobotCounterReportUtil
{

    public function transformList($items)
    {
        $data = $totalDate = $totalLabel = $listBot = [];
        foreach ($items as $item)
        {
            $bot         = $item->bot;
            $labelPage   = $item->label_page;
            $totalVisit  = $item->total_visit;
            $date        = $item->date;
            $path        = $item->path;
            $avgTime     = $item->avg_execute_time / 1000;
            $totalTime   = $item->total_time / 1000;

            // Gán các item cho từng path_page theo ngày
            $data[$date][$labelPage][$path][$bot] = [
                'total_visit' => $totalVisit,
                'avg_time'    => $avgTime,
                'total_time'  => $totalTime,
            ];
            // Tính tổng các chỉ số theo ngày
            $dataBotDate = $totalDate[$date][$bot] ?? [];
            $dataBotDate = [
                'total_visit' => isset($dataBotDate['total_visit']) ? $dataBotDate['total_visit'] + $totalVisit : $totalVisit,
                'avg_time'    => isset($dataBotDate['avg_time']) ? $dataBotDate['avg_time'] + $avgTime : $avgTime,
                'total_time'  => isset($dataBotDate['total_time']) ? $dataBotDate['total_time'] + $totalTime : $totalTime,
            ];
            $totalDate[$date][$bot] = $dataBotDate;
            // Tính tổng các chỉ số theo label page của từng ngày
            $dataBotLabel = $totalLabel[$date][$labelPage][$bot] ?? [];
            $dataBotLabel = [
                'total_visit' => isset($dataBotLabel['total_visit']) ? $dataBotLabel['total_visit'] + $totalVisit : $totalVisit,
                'avg_time'    => isset($dataBotLabel['avg_time']) ? $dataBotLabel['avg_time'] + $avgTime : $avgTime,
                'total_time'  => isset($dataBotLabel['total_time']) ? $dataBotLabel['total_time'] + $totalTime : $totalTime,
            ];
            $totalLabel[$date][$labelPage][$bot] = $dataBotLabel;

            $listBot[] = $bot;
        }

        $listBot = array_unique($listBot);
        ksort($listBot);

        return [
            'list_bot'    => $listBot,
            'data'        => $data,
            'total_date'  => $totalDate,
            'total_label' => $totalLabel,
        ];
    }

    public function transformForChart($items, $dates = [])
    {
        $data = $dataCompare = $dataOverView = [];
        foreach ($items as $item)
        {
            $bot         = $item->bot;
            $labelPage   = $item->label_page;
            $totalVisit  = $item->total_visit;
            $date        = $item->date;
            $path        = $item->path;
            $totalTime   = $item->total_time / 1000;

            $dataOverViewBot = $dataOverView[$bot] ?? [];

            // Tính tổng các chỉ số của từng bot vào từng ngày
            $dataOverViewBot['total_visit'][$date] = isset($dataOverViewBot['total_visit'][$date]) ? $dataOverViewBot['total_visit'][$date] + $totalVisit : $totalVisit;
            $dataOverViewBot['total_time'][$date]  = isset($dataOverViewBot['total_time'][$date]) ? $dataOverViewBot['total_time'][$date] + $totalTime : $totalTime;
            $dataOverViewBot['avg_time'][$date]    = round($dataOverViewBot['total_time'][$date] / $dataOverViewBot['total_visit'][$date], 3);

            $dataOverView[$bot] = $dataOverViewBot;

            // Tính tổng các chỉ số của từng bot vào từng ngày theo path và label_page
            $dataBot = $data[$bot] ?? [];

            $dataBot['path_page'][$path]['total_visit'][$date] = $totalVisit;
            $dataBot['path_page'][$path]['total_time'][$date]  = $totalTime;
            $dataBot['path_page'][$path]['avg_time'][$date]    = round($totalTime / $totalVisit, 3);

            $dataBot['label_page'][$labelPage]['total_visit'][$date] = isset($dataBot['label_page'][$labelPage]['total_visit'][$date]) ? $dataBot['label_page'][$labelPage]['total_visit'][$date] + $totalVisit : $totalVisit;
            $dataBot['label_page'][$labelPage]['total_time'][$date]  = isset($dataBot['label_page'][$labelPage]['total_time'][$date]) ? $dataBot['label_page'][$labelPage]['total_time'][$date] + $totalTime : $totalTime;
            $dataBot['label_page'][$labelPage]['avg_time'][$date]    = round($dataBot['label_page'][$labelPage]['total_time'][$date] / $dataBot['label_page'][$labelPage]['total_visit'][$date], 3);

            $data[$bot] = $dataBot;
        }

        // Gán giá trị 0 cho các ngày k có dữ liệu
        foreach ($dates as $date)
        {
            foreach ($dataOverView as $bot => $dataOverViewBot)
            {
                $dataOverViewBot['total_visit'][$date] = $dataOverViewBot['total_visit'][$date] ?? 0;
                $dataOverViewBot['total_time'][$date]  = $dataOverViewBot['total_time'][$date] ?? 0;
                $dataOverViewBot['avg_time'][$date]    = $dataOverViewBot['avg_time'][$date] ?? 0;

                $dataOverView[$bot] = $dataOverViewBot;
            }

            foreach ($data as $bot => $dataBot)
            {
                foreach ($dataBot['path_page'] as $path => $dataPath)
                {
                    $dataBot['path_page'][$path]['total_visit'][$date] = $dataBot['path_page'][$path]['total_visit'][$date] ?? 0;
                    $dataBot['path_page'][$path]['total_time'][$date]  = $dataBot['path_page'][$path]['total_time'][$date] ?? 0;
                    $dataBot['path_page'][$path]['avg_time'][$date]    = $dataBot['path_page'][$path]['avg_time'][$date] ?? 0;

                    $dataCompare['path_page'][$path][$bot][$date] = $dataBot['path_page'][$path]['total_visit'][$date];
                }

                foreach ($dataBot['label_page'] as $label => $dataLabel)
                {
                    $dataBot['label_page'][$label]['total_visit'][$date] = $dataBot['label_page'][$label]['total_visit'][$date] ?? 0;
                    $dataBot['label_page'][$label]['total_time'][$date]  = $dataBot['label_page'][$label]['total_time'][$date] ?? 0;
                    $dataBot['label_page'][$label]['avg_time'][$date]    = $dataBot['label_page'][$label]['avg_time'][$date] ?? 0;

                    $dataCompare['label_page'][$label][$bot][$date] = $dataBot['label_page'][$label]['total_visit'][$date];
                }

                $data[$bot] = $dataBot;
            }
        }

        return [
            'data_bot'       => $data,
            'data_over_view' => $dataOverView,
            'data_compare'   => $dataCompare,
            'dates'          => $dates
        ];
    }
}
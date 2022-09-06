<?php
namespace Workable\GoogleLog\Utils;

class ClientEventReportUtil
{

    public function transformList($items)
    {
        $data = $totalDate = $totalLabel = [];
        foreach ($items as $item)
        {
            $eventText = $item->event_text;
            $labelPage = $item->label_page;
            $hit       = $item->hit;
            $date      = $item->source_created_at;
            $path      = $item->path;
            // Gán các item cho từng path_page theo ngày
            $data[$date][$labelPage][$path][$eventText] = $hit;
            // Tính tổng các chỉ số theo ngày
            $totalDate[$date][$eventText] = isset($totalDate[$date][$eventText])
                                            ? $totalDate[$date][$eventText] + $hit
                                            : $hit;
            // Tính tổng các chỉ số theo label page của từng ngày
            $totalLabel[$date][$labelPage][$eventText] = isset($totalLabel[$date][$labelPage][$eventText])
                                                        ? $totalLabel[$date][$labelPage][$eventText] + $hit
                                                        : $hit;
        }

        return [
            'data'              => $data,
            'total_date'        => $totalDate,
            'total_label'       => $totalLabel,
        ];
    }

    public function transformForChart($items, $dates = [])
    {
        $dataLabel = $dataPath = $dataComparePath = [];
        foreach ($items as $item)
        {
            $eventText = $item->event_text;
            $labelPage = $item->label_page;
            $path      = $item->path;
            $hit       = $item->hit;
            $date      = $item->source_created_at;
            // Tính tổng các sự kiện của từng ngày theo label page
            $dataLabel[$labelPage][$eventText][$date] = isset($dataLabel[$labelPage][$eventText][$date])
                                                        ? $dataLabel[$labelPage][$eventText][$date] + $hit
                                                        : $hit;

            // Tính tổng các sự kiện của từng ngày theo path
            $dataPath[$path][$eventText][$date] =  $hit;

            $dataComparePath[$eventText][$path][$date] = $hit;

        }

        // Gán giá trị 0 cho các ngày k có dữ liệu
        foreach ($dates as $date)
        {
            foreach ($dataPath as $path => $data)
            {
                foreach ($data as $event => $dataEvent)
                {
                    $dataEvent[$date] = $dataEvent[$date] ?? 0;
                    $dataPath[$path][$event] = $dataEvent;
                }
            }

            foreach ($dataLabel as $label => $data)
            {
                foreach ($data as $event => $dataEvent)
                {
                    $dataEvent[$date] = $dataEvent[$date] ?? 0;
                    $dataLabel[$label][$event] = $dataEvent;
                }
            }

            foreach ($dataComparePath as $event => $dataEvent)
            {
                foreach ($dataEvent as $path => $dataItemPath)
                {
                    $dataItemPath[$date] = $dataItemPath[$date] ?? 0;
                    $dataComparePath[$event][$path] = $dataItemPath;
                }
            }
        }

        return [
            'data_label'        => $dataLabel,
            'data_path'         => $dataPath,
            'data_compare_path' => $dataComparePath,
            'dates'             => $dates
        ];
    }


    public function transformReportDay($items)
    {
        $results = [];
        foreach ($items as $item)
        {
            $date  = $item->source_created_at;
            $datas = $item->data;
            $datas = explode(',', $datas);
            foreach ($datas as $data)
            {
                $data = explode('=', $data);
                $key  = $data[0];
                if(isset($results[$date][$key])) $results[$date][$key] += $data[1];
                else $results[$date][$key] = $data[1];
            }
        }
        return $results;
    }

    public function transformReportMonth($items)
    {
        $results = [];
        foreach ($items as $item)
        {
            $month = $item->month_time;
            $total = $item->total;
            $index = $item->event_text;
            $results[$month][$index] = $total;
        }
        return $results;
    }


}
<?php
namespace Workable\GoogleLog\Utils;

use Workable\GoogleLog\Enum\GoogleLogEnum;

class GoogleLogReportUtil
{

    public function transformList($items)
    {
        $data = $totalDate = $totalLabel = $bounceRateRecord = [];
        foreach ($items as $item)
        {
            $logText   = $item->log_text;
            $labelPage = $item->label_page;
            $hit       = $item->hit;
            $date      = $item->source_created_at;
            $path      = $item->path;
            // Gán các item cho từng path_page theo ngày
            $data[$date][$labelPage][$path][$logText] = $hit;
            // Tính tổng các chỉ số theo ngày
            $totalDate[$date][$logText] = isset($totalDate[$date][$logText])
                                        ? $totalDate[$date][$logText] + $hit
                                        : $hit;
            // Tính tổng các chỉ số theo label page của từng ngày
            $totalLabel[$date][$labelPage][$logText] = isset($totalLabel[$date][$labelPage][$logText])
                                                        ? $totalLabel[$date][$labelPage][$logText] + $hit
                                                        : $hit;
            if($logText == GoogleLogEnum::LOG[GoogleLogEnum::LOG_BOUNCE_RATE])
                $bounceRateRecord[$date] = isset($bounceRateRecord[$date])
                                            ? $bounceRateRecord[$date] + 1
                                            : 1;
        }

        foreach ($totalDate as $date => $item)
        {
            $bounceRateText = GoogleLogEnum::LOG[GoogleLogEnum::LOG_BOUNCE_RATE];
            $totalDate[$date][$bounceRateText] = round($item[$bounceRateText] / $bounceRateRecord[$date], 2);
        }

        return [
            'data'              => $data,
            'total_date'        => $totalDate,
            'total_label'       => $totalLabel,
        ];
    }

    public function transformForChart($items, $dates)
    {
        $dataLabel = $bounceRateLabel = $dataPath = $dataIndex = [];
        foreach ($items as $item)
        {
            $logText   = $item->log_text;
            $logInt    = $item->log_int;
            $labelPage = $item->label_page;
            $path      = $item->path;
            $hit       = round($item->hit);
            $date      = $item->source_created_at;

            // Tính tổng các chỉ số của từng ngày theo label page
            $dataLabel[$labelPage][$logText][$date] = isset($dataLabel[$labelPage][$logText][$date])
                                                        ? $dataLabel[$labelPage][$logText][$date] + $hit
                                                        : $hit;

            // Tính tổng các chỉ số của từng ngày theo path
            $dataPath[$path][$logText][$date] = $hit;

            // Tính số bản ghi bounce rate của từng ngày theo label page
            if($logInt == GoogleLogEnum::LOG_BOUNCE_RATE)
                $bounceRateLabel[$labelPage][$logText][$date] = isset($bounceRateLabel[$labelPage][$logText][$date])
                                                            ? $bounceRateLabel[$labelPage][$logText][$date] + 1
                                                            : 1;

            $dataIndex[$logText][$path][$date] = $hit;

        }

        // Tính chỉ số bounce rate trung bình của từng ngày theo label page
        foreach ($bounceRateLabel as $label => $items)
        {
            foreach ($items as $index => $item)
            {
                foreach ($item as $date => $val)
                {
                    $dataLabel[$label][$index][$date] = round($dataLabel[$label][$index][$date] / $val);
                }
            }
        }
        foreach ($dates as $date)
        {
            foreach ($dataLabel as $label => $itemLabel)
            {
                foreach ($itemLabel as $index => $itemIndex)
                {
                    $itemLabel[$index][$date] = $itemIndex[$date] ?? 0;
                }
                $dataLabel[$label] = $itemLabel;
            }
            foreach ($dataPath as $path => $itemPath)
            {
                foreach ($itemPath as $index => $itemIndex)
                {
                    $itemPath[$index][$date] = $itemIndex[$date] ?? 0;
                }
                $dataPath[$path] = $itemPath;
            }

            foreach ($dataIndex as $index => $itemIndex)
            {
                foreach ($itemIndex as $path => $itemPath)
                {
                    $itemIndex[$path][$date] = $itemPath[$date] ?? 0;
                }
                $dataIndex[$index] = $itemIndex;
            }
        }
        return [
            'data_label' => $dataLabel,
            'data_path'  => $dataPath,
            'data_index' => $dataIndex,
            'dates'      => $dates,
        ];
    }

    public function transformReportDay($items)
    {
        $results = [];
        foreach ($items as $item)
        {
            $date            = $item->source_created_at;
            $datas           = $item->data;
            $datas           = explode(',', $datas);
            $bounceRate      = 0;
            $totalBounceRate = 0;
            foreach ($datas as $data)
            {
                $data = explode('=', $data);
                $key  = $data[0];
                if($key == 'ga_bounce_rate')
                {
                    $bounceRate      += $data[1];
                    $totalBounceRate += 1;
                }
                else
                {
                    if(isset($results[$date][$key])) $results[$date][$key] += $data[1];
                    else $results[$date][$key] = round($data[1]);
                }
            }
            $results[$date]['ga_bounce_rate'] = round($bounceRate / $totalBounceRate, 2);
        }
        return $results;
    }

    public function transformReportMonth($items)
    {
        $results = [];
        foreach ($items as $item)
        {
            $month        = $item->month_time;
            $total        = $item->total;
            $total_record = $item->total_record;
            $index        = $item->log_text;
            if ($index == 'ga_bounce_rate')
            {
                $results[$month][$index] = round($total / $total_record, 2);
            }
            else $results[$month][$index] = round($total);
        }
        return $results;
    }


}
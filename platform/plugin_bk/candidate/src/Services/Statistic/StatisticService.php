<?php
/**
 * Created by PhpStorm.
 * User: dinhhuong
 * Date: 4/8/21
 * Time: 11:48 AM
 */

namespace Workable\Candidate\Services\Statistic;

use Workable\Base\Supports\CliEcho;

class StatisticService
{
    /**
     * Thống kê số lượng cv theo tháng và lũy kế nó lên
     * @return array
     */
    public function statisticCandidate()
    {
        $response = [];
        $data     = \DB::table('candidates')
                ->select(\DB::raw("DATE_FORMAT(added_at, '%m/%Y') as date, source_int, source_text, COUNT(*) as total"))
                ->groupBy('date', 'source_int', 'source_text')
                ->get();

        foreach ($data as $item)
        {
            $date       = '01/' . $item->date;
            $date       = str_replace('/', '-', $date);
            $response[] = [
                'total'       => $item->total,
                'date'        => $item->date,
                'timestamp'   => strtotime($date),
                'source_int'  => $item->source_int,
                'source_text' => $item->source_text,
            ];
        }

        return $response;
    }

    /**
     * Lưu cv report theo tháng
     * @param array $input
     */
    public function saveCvReport(array $input)
    {
        $data     = [
            'total'       => $input['total'],
            'quarter'     => ceil(date('n') / 3),
            'date'        => $input['date'],
            'timestamp'   => $input['timestamp'],
            'source_int'  => $input['source_int'],
            'source_text' => $input['source_text'],
        ];
        $recordId = \DB::table('cv_reports')
            ->where('date', $input['date'])
            ->where('source_int', $input['source_int'])
            ->value('id');
        if (empty($recordId))
        {
            $data = array_merge($data, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            \DB::table('cv_reports')->insert($data);
            CliEcho::successnl('-- Tạo mới thống kê cv_report ngày ' . $data['date'] . ' tổng ' . $data['total'] . ' nguồn ' . $data['source_text']);
        }
        else
        {
            $data = array_merge($data, [
                'updated_at' => now(),
            ]);
            \DB::table('cv_reports')->where('id', $recordId)->update($data);
            CliEcho::successnl('-- Cập nhật thống kê cv_report ngày ' . $data['date'] . ' tổng ' . $data['total'] . ' nguồn ' . $data['source_text']);
        }
    }

    /**
     * Thống kê dữ liệu theo trường cố định
     * @param string $column
     * @param string|null $date
     * @return null
     */
    public function statisticFollowColumn(string $column, string $date = '')
    {
        if (!in_array($column, ['career', 'rank', 'degree'])) return null;
        $response   = [];
        $columnInt  = $column . '_int';
        $columnText = $column . '_text';
        $date       = $date ?: date('Y-m-d');
        $data       = \DB::table('candidates')
            ->select([$columnInt, $columnText, 'source_int', 'source_text', \DB::raw("COUNT(*) as total")])
            ->groupBy($columnInt, $columnText, 'source_int', 'source_text')
            ->when($date, function ($query) use ($date)
            {
                return $query->whereDate('added_at', '=', $date);
            })
            ->get();
        foreach ($data as $item)
        {
            $col        = $column . '_id';
            $response[] = [
                $col          => $item->$columnInt,
                $columnText   => $item->$columnText,
                'total'       => $item->total,
                'date'        => $date,
                'timestamp'   => strtotime($date),
                'source_int'  => $item->source_int,
                'source_text' => $item->source_text,
            ];
        }

        return $response;
    }

    /*
   * Thống kê tổng lũy kế những tháng trở về sau
   */
    public function statisticTotalAllFollowColumn(string $date, string $table)
    {
        if (empty($table)) return null;
        $table = $table . '_reports';

        return \DB::table($table)->where('timestamp', '<', strtotime($date))->sum('total');
    }

    /**
     * Lưu dữ liệu thống kê candidate theo column
     * @param array $inputs
     * @param string $name
     * @return null
     */
    public function saveReportFollowColumn(array $inputs, string $name)
    {
        if (empty($name)) return null;
        $col       = $name . '_id';
        $col_value = $name . '_text';
        $table     = $name . '_reports';
        foreach ($inputs as $data)
        {
            $recordId = \DB::table($table)
                ->where($col, $data[$col])
                ->where('source_int', $data['source_int'])
                ->where('date', $data['date'])
                ->value('id');
            if (empty($recordId))
            {
                $data = array_merge($data, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                \DB::table($table)->insert($data);
                CliEcho::successnl('-- ' . mb_strtoupper($name) . ' -> Tạo mới thống kê "' . $data[$col_value] . '" ngày ' . $data['date'] . ' tổng ' . $data['total']);
            }
            else
            {
                $data = array_merge($data, [
                    'updated_at' => now(),
                ]);
                \DB::table($table)->where('id', $recordId)->update($data);
                CliEcho::successnl('-- ' . mb_strtoupper($name) . ' -> Cập nhật thống kê "' . $data[$col_value] . '" ngày ' . $data['date'] . ' tổng ' . $data['total']);
            }
        }
    }
}


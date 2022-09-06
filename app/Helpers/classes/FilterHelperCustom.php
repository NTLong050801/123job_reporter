<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 09/04/2021
 * Time: 14:49
 */

namespace App\Helpers\classes;


use Carbon\Carbon;

class FilterHelperCustom
{
    /**
     * Note:
     * @param $month_range
     * @param array $config
     * @return array
     * User: TranLuong
     * Date: 09/04/2021
     */
    public static function getStartEndMonthTimestamp($month_range = '', $config = []): array
    {
        if ($month_range)
        {
            $dates      = explode(' – ', $month_range);
            dd($dates);
            $start_date = Carbon::createFromFormat('m/Y', $dates[0])->startOfMonth()->timestamp;
            $end_date   = Carbon::createFromFormat('m/Y', $dates[1])->endOfMonth()->timestamp;
        }
        else
        {
            $start_date = Carbon::now()->startOfMonth()->subYear()->subMonth()->timestamp;
            $end_date   = Carbon::now()->endOfMonth()->timestamp;
        }

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }

    /**
     * Note:
     * @param $month_range
     * @param array $config
     * @return array
     * User: TranLuong
     * Date: 09/04/2021
     */
    public static function getStartEndMonth($month_range = '', $config = []): array
    {
        if ($month_range)
        {
            $dates      = explode(' – ', $month_range);
            $start_date = Carbon::createFromFormat('m/Y', $dates[0])->startOfMonth()->format('Y-m-d');
            $end_date   = Carbon::createFromFormat('m/Y', $dates[1])->startOfMonth()->format('Y-m-d');
        }
        else
        {
            $start_date = Carbon::now()->subYear()->subMonth()->format('Y-m-d');
            $end_date   = Carbon::now()->format('Y-m-d');
        }

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }

    /**
     * Note:
     * @param $month_range
     * @param array $config
     * @return array
     * User: TranLuong
     * Date: 09/04/2021
     */
    public static function getStartEndMonthSingle($month_range = '', $config = []): array
    {
        if ($month_range)
        {
            $month_range_ = explode(' – ', $month_range);
            $start_date   = Carbon::createFromFormat('m/Y', $month_range_[0])->format('Y-m');
            $end_date     = Carbon::createFromFormat('m/Y', $month_range_[1])->format('Y-m');
        }
        else
        {
            $start_date = Carbon::now()->subYear()->format('Y-m');
            $end_date   = Carbon::now()->format('Y-m');
        }

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }
}
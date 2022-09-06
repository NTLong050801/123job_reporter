<?php

use Illuminate\Support\Arr;

/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 1/3/18
 * Time: 4:09 PM
 */

class FilterHelper
{
    public static $time_list = [
        '1' => 'Today',
        '2' => 'Yesterday',
        '3' => 'This week',
        '4' => 'Last week',
        '5' => 'This month',
        '6' => 'Last month'
    ];

    /**
     * Filter list
     *
     * @var array
     */
    protected $filter = [];

    /**
     * Created by : BillJanny
     * Date: 11:42 PM - 2/4/2017
     * Set mot vai thuoc tinh filter
     *
     * @param $field
     * @param $ope
     * @param $defValue
     *
     * @return
     */
    public function setFilter(\Illuminate\Http\Request $request, $field, $ope, $defValue = null)
    {
        $value = ($defValue == null) ? $request->get($field) : $defValue;
        if ($value != '' || $value != null)
        {
            if (strtoupper($ope) == 'LIKE')
            {
                $value = '%' . trim($value) . '%';
            }
            $this->filter[] = [$field, $ope, trim($value)];
        }
    }

    /**
     * Get all filter
     *
     * @return [type] [description]
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * B
     *
     * @param $date_range
     *
     * @return array
     */
    public static function getStartEndTime($date_range, $config = [], $separator = ' - ')
    {
        $dates = explode($separator, $date_range);

        if (Arr::get($config, 'his'))
        {
            $start_date = date('Y-m-d H:i:s', strtotime($dates[0]));
            $end_date   = date('Y-m-d H:i:s', strtotime($dates[1]));
        }
        else
        {
            $start_date = date('Y-m-d 00:00:00', strtotime($dates[0]));
            $end_date   = date('Y-m-d 23:59:59', strtotime($dates[1]));
        }

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }


    public static function getStartEndTimeFromDate($date)
    {
        $start_date = date('Y-m-d 00:00:00', strtotime($date));
        $end_date   = date('Y-m-d 23:59:59', strtotime($date));

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }

    /**
     * @param string $date_range 01/05/2020 - 31/05/2020
     *
     * @return array [
     *                  'start' => '2020-05-01',
     *                  'end' => '2020-05-01',
     *               ]
     */
    public static function getStartEndTimeVn(string $date_range, $separator = ' - ', $format = 'd/m/Y')
    {
        $dates = explode($separator, $date_range);
        list($start, $end) = $dates;

        $start_date = \Carbon\Carbon::createFromFormat($format, $start)->toDateString();
        $end_date   = \Carbon\Carbon::createFromFormat($format, $end)->toDateString();

        return [
            'start' => $start_date,
            'end'   => $end_date
        ];
    }
}
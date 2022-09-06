<?php

namespace Modules\Monitor\Enum;

class MonitorEnum
{

    const STATUS_YES = 1;
    const STATUS_NO = 0;

    public static $statusText = [
       0 => [
           'name' => 'No'
       ],
        1 => [
            'name' => 'Yes'
        ]
    ];

    public static function uptimeStatus($status,$time,$uptime_check) {
        if ($status == 'Up') {
            return '<span class="label label-success">'.$status.' ('.$time.'ms)</span>';
        }
        elseif ($status == 'Down') {
            return '<span class="label label-danger">'.$status.' ('.$time.'ms)</span>';
        }
        elseif ($uptime_check == 0) {
            return '<span class="label label-warning">Pause</span>';
        }
        else
            return '';

    }

     public static $responseChecker = [
         'LookForStringChecker' => [
             'name' => 'LOOK_FOR_STRING'
         ],
         'CheckWithPerformance' => [
             'name' => 'CHECK_WITH_PERFORMANCE'
         ],
         'JsonChecker' => [
             'name' => 'CHECK_JSON'
         ],
         'CheckWithPageSpeed' => [
             'name' => 'CHECK_WITH_PAGESPEED'
         ]
     ];

    const STATUS = [
        self::STATUS_YES => [
            'title' => 'Yes',
            'class' => 'label label-success'
        ],
        self::STATUS_NO => [
            'title' => 'No',
            'class' => 'label label-default'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::STATUS[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['title'] .'</label>';
    }

    public static function responseChecked($checked) {
        $responseChecked = self::$responseChecker[$checked];

        return $responseChecked['name'];

    }



}

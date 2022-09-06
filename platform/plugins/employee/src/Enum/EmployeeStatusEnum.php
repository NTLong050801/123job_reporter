<?php


namespace Workable\Employee\Enum;


class EmployeeStatusEnum
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const STATUS = [
        self::STATUS_INACTIVE => [
            'title' => 'Đang dừng',
            'class' => 'label label-danger'
        ],

        self::STATUS_ACTIVE => [
            'title' => 'Hoạt động',
            'class' => 'label label-success'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::STATUS[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['title'] .'</label>';
    }
}

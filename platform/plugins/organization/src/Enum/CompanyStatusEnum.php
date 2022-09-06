<?php


namespace Workable\Organization\Enum;


class CompanyStatusEnum
{
    const STATUS_IN_ACTIVE = -1;
    const STATUS_ACTIVE = 1;

    public static $statusText = [
        -1 => [
            'name' => 'Ngừng hoạt động',
            'class' => 'label label-danger'
        ],
        1 => [
            'name' => 'Đang hoạt động',
            'class' => 'label label-success'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

<?php


namespace Workable\Organization\Enum;


class ProductStatusEnum
{
    const STATUS_INACTIVE = -1;
    const STATUS_ACTIVE = 0;

    public static $statusText = [
        -1 => [
            'name' => 'Ngừng hoạt động',
            'class' => 'label label-danger'
        ],
        0 => [
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

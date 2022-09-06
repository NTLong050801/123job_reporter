<?php


namespace Modules\Company\Enum;


class MenuStatusEnum
{
    const STATUS_DELETE = -1;
    const STATUS_INIT = 0;
    const STATUS_SHOW = 1;

    public static $statusText = [
        -1 => [
            'name' => 'Đã xóa',
            'class' => 'label label-danger'
        ],
        0 => [
            'name' => 'Khởi tạo',
            'class' => 'label label-info'
        ],
        1 => [
            'name' => 'Hiển thị',
            'class' => 'label label-success'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

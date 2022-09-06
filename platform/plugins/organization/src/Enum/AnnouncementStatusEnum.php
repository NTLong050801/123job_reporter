<?php


namespace Workable\Organization\Enum;


class AnnouncementStatusEnum
{
    const STATUS_HIDE = 0;
    const STATUS_SHOW = 1;
    const STATUS_REMOVE = -1;

    public static $statusText = [
        0 => [
            'name' => 'Ẩn',
            'class' => 'label label-warning'
        ],
        1 => [
            'name' => 'Hiện',
            'class' => 'label label-info'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

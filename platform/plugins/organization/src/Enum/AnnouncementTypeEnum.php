<?php


namespace Workable\Organization\Enum;


class AnnouncementTypeEnum
{
    const TYPE_DECISION = 1;
    const TYPE_ANNOUNCEMENT = 2;

    public static $statusText = [
        1 => [
            'name' => 'Quyết định',
            'class' => ''
        ],
        2 => [
            'name' => 'Thông báo',
            'class' => ''
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return $statusItem['name'];
    }
}

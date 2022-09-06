<?php

namespace Workable\ManagerSite\Enum;

class SiteStatusEnum
{
    const STATUS_IN_ACTIVE = -1;
    const STATUS_ACTIVE = 1;
    const DASHBOARD_ACTIVE = 1;
    const DASHBOARD_HIDDEN = -1;

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

    public static $continents = [
        'Asia' => [
            'name' => 'Châu Á',
            'slug' => 'Asia'
        ],
        'Europe'=> [
            'name' => 'Châu Âu',
            'slug' => 'Europe'

        ],
        'America' => [
            'name' => 'Châu Mỹ',
            'slug' => 'America'

        ],
        'Africa' => [
            'name' => 'Châu Phi',
            'slug' => 'Africa'

        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }

    public static function continent($status)
    {
        $statusItem = self::$continents[$status];
        return '<label class="label label-primary">'. $statusItem['name'] .'</label>';
    }

}

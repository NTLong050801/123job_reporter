<?php


namespace Workable\Organization\Enum;


class ProductTypePaymentEnum
{
    const TYPE_ONE  = 1;
    const TYPE_TIME = 2;

    public static $statusText = [
        1 => [
            'name' => 'Tính phí 1 lần',
            'class' => 'label label-info'
        ],
        2 => [
            'name' => 'Tính phí theo thời gian',
            'class' => 'label label-success'
        ]
    ];

    public static function type($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

<?php
namespace Workable\Attribute\Enum;

class AttributeStatusEnum
{
    const STATUS_IN_ACTIVE = -1;
    const STATUS_ACTIVE = 0;

    public static $statusText = [
        0 => [
            'name' => 'Hoạt động',
            'class' => 'label label-success'
        ],
        -1 => [
            'name' => 'Không hoạt động',
            'class' => 'label label-danger'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

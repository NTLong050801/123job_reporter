<?php


namespace Workable\AuditLog\Enum;


class ActivityActionEnum
{
    const ACTION_DELETE = 'deleted';
    const ACTION_CREATE = 'created';
    const ACTION_UPDATE = 'updated';

    public static $actionText = [
        self::ACTION_CREATE => [
            'name' => 'created',
            'class' => 'label label-success'
        ],
        self::ACTION_UPDATE => [
            'name' => 'updated',
            'class' => 'label label-warning'
        ],
        self::ACTION_DELETE => [
            'name' => 'deleted',
            'class' => 'label label-danger'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$actionText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

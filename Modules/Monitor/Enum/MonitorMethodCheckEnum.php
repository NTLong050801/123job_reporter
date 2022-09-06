<?php

namespace Modules\Monitor\Enum;

class MonitorMethodCheckEnum
{

    const GET_METHOD    = 0;
    const POST_METHOD   = 1;
    const HEAD_METHOD   = 2;
    const DELETE_METHOD = 3;

    public static $methodCheck = [
        0 => [
            'name' => 'GET'
        ],
        1 => [
            'name' => 'POST'
        ],
        2 => [
            'name' => 'HEAD'
        ],
        3 => [
            'name' => 'DELETE'
        ]
    ];
}

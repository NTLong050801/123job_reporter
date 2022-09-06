<?php

return [
    'system' => [
        [
            'title'        => 'Log request admin',
            'name'         => 'get.system.logs.index',
            'uri'          => '/system/logs/index',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu' => [],
        ],
        [
            'title'        => 'Log request main',
            'name'         => 'get.system.logs.main',
            'uri'          => '/system/logs/main',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu' => [],
        ],
        [
            'title'        => 'Query slow admin',
            'name'         => '',
            'uri'          => '',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu' => [],
        ],
        [
            'title'        => 'Query slow main',
            'name'         => '',
            'uri'          => '',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu' => [],
        ],
        [
            'title'        => 'Opache',
            'name'         => '',
            'uri'          => '',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu' => [],
        ],
        [
            'title'        => 'Backup',
            'name'         => '',
            'uri'          => '',
            'show_sidebar' => 1,
            'plugin'       => 'system',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => '',
                    'uri'          => '',
                    'show_sidebar' => 1,
                    'plugin'       => 'system',
                ],
            ]
        ],
    ]
];
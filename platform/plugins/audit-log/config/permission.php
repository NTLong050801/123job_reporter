<?php
return [
    'company'     => [
        [
            'title'        => 'Nhật kí hoạt động',
            'name'         => 'get.employee',
            'uri'          => '/company/history',
            'show_sidebar' => 1,
            'plugin'       => 'audit-log',
            'menu'         => [
                [
                    'title'        => 'Danh sách hoạt động',
                    'name'         => 'get.employee.activity',
                    'uri'          => '/company/history/index',
                    'show_sidebar' => 1,
                    'plugin'       => 'audit-log',
                ],
                [
                    'title'        => 'Lịch sử login gần đây',
                    'name'         => 'get.employee.history-login',
                    'uri'          => '/company/history/history-login',
                    'show_sidebar' => 1,
                    'plugin'       => 'audit-log',
                ]
            ]
        ]
    ],
];

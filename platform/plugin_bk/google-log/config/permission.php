<?php
return [
    'analytic'     => [
        [
            'title'        => 'Google analytic',
            'name'         => 'get.google_analytic',
            'uri'          => '/analytic/google-analytic',
            'show_sidebar' => 1,
            "plugin"       => "google-log",
            'menu'         => [
                [
                    'title'        => 'Người dùng',
                    'name'         => 'get.google_analytic.user',
                    'uri'          => '/analytic/google-analytic/user',
                    "plugin"       => "google-log",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Sự kiện',
                    'name'         => 'get.google_analytic.event',
                    'uri'          => '/analytic/google-analytic/event',
                    "plugin"       => "google-log",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thống kê người dùng',
                    'name'         => 'get.google_analytic.user_chart',
                    'uri'          => '/analytic/google-analytic/user-chart',
                    "plugin"       => "google-log",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thống kê sự kiện',
                    'name'         => 'get.google_analytic.event_chart',
                    'uri'          => '/analytic/google-analytic/event-chart',
                    "plugin"       => "google-log",
                    'show_sidebar' => 1,
                ],
            ]
        ],
    ],
];

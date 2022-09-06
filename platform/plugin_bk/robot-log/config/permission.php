<?php
return [
    'analytic'     => [
        [
            'title'        => 'Bot truy cập',
            'name'         => 'get.robot_visit',
            'uri'          => '/analytic/robot',
            'show_sidebar' => 1,
            "plugin"       => "robot-log",
            'menu'         => [
                [
                    'title'        => 'Danh sách truy cập',
                    'name'         => 'get.robot_visit.index',
                    'uri'          => '/analytic/robot/visit-index',
                    "plugin"       => "robot-log",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thống kê theo ngày',
                    'name'         => 'get.robot_counter.by_day',
                    'uri'          => '/analytic/robot/counter-by-day',
                    "plugin"       => "robot-log",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Biểu đồ truy cập',
                    'name'         => 'get.robot_counter.chart',
                    'uri'          => '/analytic/robot/counter-chart',
                    "plugin"       => "robot-log",
                    'show_sidebar' => 1,
                ],
            ]
        ],
    ],
];

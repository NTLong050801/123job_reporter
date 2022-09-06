<?php
return [
    'product' => [
        [
            'title'        => 'Thống kê hồ sơ',
            'name'         => 'get.report_resume',
            'uri'          => '/candidates/report-resume',
            'show_sidebar' => 1,
            'plugin'       => 'candidates',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => 'get.report_resume.list',
                    'uri'          => '/candidates/report-resume/list',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ],
                [
                    'title'        => 'Số lượng',
                    'name'         => 'get.report_resume.amount',
                    'uri'          => '/candidates/report-resume/amount',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ]
            ]
        ],
        [
            'title'        => 'Thống kê hồ sơ biểu đồ',
            'name'         => 'get.report_resume_chart',
            'uri'          => '/candidates/report-static',
            'show_sidebar' => 1,
            'plugin'       => 'candidates',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => 'get.report_resume_chart.list',
                    'uri'          => '/candidates/report-resume/list-index',
                    'show_sidebar' => -1,
                    'plugin'       => 'candidates',
                ],
                [
                    'title'        => 'Ngành nghề',
                    'name'         => 'get.report_resume_chart.list_career',
                    'uri'          => '/candidates/report-resume/chart-career',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ],
                [
                    'title'        => 'Cấp bậc',
                    'name'         => 'get.report_resume_chart.list_rank',
                    'uri'          => '/candidates/report-resume/chart-rank',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ],
                [
                    'title'        => 'Trình độ học vấn',
                    'name'         => 'get.report_resume_chart.list_degree',
                    'uri'          => '/candidates/report-resume/list-degree',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ],
                [
                    'title'        => 'Biểu đồ',
                    'name'         => 'get.report_resume_chart.chart',
                    'uri'          => '/candidates/report-resume/chart',
                    'show_sidebar' => 1,
                    'plugin'       => 'candidates',
                ]
            ]
        ],
    ],
];

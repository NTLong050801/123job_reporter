<?php

return
    [
        "report" => [
            [
                'title' => 'Overview',
                'name' => 'get.overview',
                'uri' => '/report/overview',
                'show_sidebar' => 1,
                'menu' => [
                    [
                        'title' => 'SEO Content',
                        'name' => 'get.seo_content.index',
                        'uri' => '/report/seo_content/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'Reference',
                        'name' => 'get.reference.index',
                        'uri' => '/report/reference/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'Robots',
                        'name' => 'get.robot.index',
                        'uri' => '/report/robot/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'Upload/Public',
                        'name' => 'get.upload.index',
                        'uri' => '/report/upload/index',
                        'show_sidebar' => 1,
                    ], [
                        'title' => 'Apply/Reference',
                        'name' => 'get.apply.index',
                        'uri' => '/report/apply/index',
                        'show_sidebar' => 1,
                    ],
                ]
            ],
            [
                'title' => 'Report',
                'name' => 'get.report',
                'uri' => '/report/report',
                'show_sidebar' => 1,
                'menu' => [
                    [
                        'title' => 'Monitor',
                        'name' => 'get.monitor.index',
                        'uri' => '/report/monitor/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'GA',
                        'name' => 'get.ga.index',
                        'uri' => '/report/ga/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'Console',
                        'name' => 'get.console.index',
                        'uri' => '/report/console/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'Sitemap',
                        'name' => 'get.sitemap.index',
                        'uri' => '/report/sitemap/index',
                        'show_sidebar' => 1,
                    ],
                    [
                        'title' => 'PageSpeed',
                        'name' => 'get.pageSpeed.index',
                        'uri' => '/report/pageSpeed/index',
                        'show_sidebar' => 1,
                    ]
                ]
            ],
        ]

    ];

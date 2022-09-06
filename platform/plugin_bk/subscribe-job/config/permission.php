<?php
return [
    'product'     => [
        [
            'title'        => 'Subscribe Job',
            'name'         => 'get.subscribe_job',
            'uri'          => '/product/subscribe-job',
            'show_sidebar' => 1,
            "plugin"       => "subscribe-job",
            'menu'         => [
                [
                    'title'        => 'Tổng quan',
                    'name'         => 'get.subscribe_job.overview',
                    'uri'          => '/product/subscribe-job/overview',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Keyword',
                    'name'         => 'get.subscribe_job.location',
                    'uri'          => '/product/subscribe-job/location',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Location',
                    'name'         => 'get.subscribe_job.location',
                    'uri'          => '/product/subscribe-job/location',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Position',
                    'name'         => 'get.subscribe_job.position',
                    'uri'          => '/product/subscribe-job/position',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Salary',
                    'name'         => 'get.subscribe_job.salary',
                    'uri'          => '/product/subscribe-job/salary',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Attribute',
                    'name'         => 'get.subscribe_job.attribute',
                    'uri'          => '/product/subscribe-job/attribute',
                    "plugin"       => "subscribe-job",
                    'show_sidebar' => 1,
                ],
            ]
        ],
    ],
];

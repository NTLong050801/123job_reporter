<?php
return [
    'product'     => [
        [
            'title'        => 'Apply job',
            'name'         => 'get.apply_job.index',
            'uri'          => '/product/apply-job',
            'show_sidebar' => 1,
            "plugin"       => "apply-job",
            'menu'         => [
                [
                    'title'        => 'Overview',
                    'name'         => 'get.apply_job.overview',
                    'uri'          => '/product/apply-job/overview',
                    "plugin"       => "apply-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Category',
                    'name'         => 'get.apply_job.by_category',
                    'uri'          => '/product/apply-job/by-category',
                    "plugin"       => "apply-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Location',
                    'name'         => 'get.apply_job.by_location',
                    'uri'          => '/product/apply-job/by-location',
                    "plugin"       => "apply-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Salary',
                    'name'         => 'get.apply_job.by_salary',
                    'uri'          => '/product/apply-job/by-salary',
                    "plugin"       => "apply-job",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Attribute',
                    'name'         => 'get.apply_job.by_attribute',
                    'uri'          => '/product/apply-job/by-attribute',
                    "plugin"       => "apply-job",
                    'show_sidebar' => 1,
                ]
            ]
        ],
    ],
];

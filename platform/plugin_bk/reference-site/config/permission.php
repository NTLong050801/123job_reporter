<?php
return [
    'product'     => [
        [
            'title'        => 'Tổng quan',
            'name'         => 'get.product.dashboard',
            'uri'          => '/product/dashboard',
            'show_sidebar' => 1,
            'menu'         => [],
        ],
        [
            'title'        => 'Reference site',
            'name'         => 'get.reference.index',
            'uri'          => '/product/reference',
            'show_sidebar' => 1,
            "plugin"       => "reference",
            'menu'         => [
                [
                    'title'        => 'Refer overview',
                    'name'         => 'get.reference.overview',
                    'uri'          => '/product/reference/overview',
                    "plugin"       => "reference",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Refer theo website',
                    'name'         => 'get.reference.by_site',
                    'uri'          => '/product/reference/by-site',
                    "plugin"       => "reference",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Refer theo category',
                    'name'         => 'get.reference.by_category',
                    'uri'          => '/product/reference/by-category',
                    "plugin"       => "reference",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Refer theo location',
                    'name'         => 'get.reference.by_location',
                    'uri'          => '/product/reference/by-location',
                    "plugin"       => "reference",
                    'show_sidebar' => 1,
                ],[
                    'title'        => 'Refer theo salary',
                    'name'         => 'get.reference.by_salary',
                    'uri'          => '/product/reference/by-salary',
                    "plugin"       => "reference",
                    'show_sidebar' => 1,
                ]
            ]
        ],
    ],
];

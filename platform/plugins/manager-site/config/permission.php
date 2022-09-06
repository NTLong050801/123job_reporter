<?php

return [
    'company' => [
        [
            'title' => 'Quản lý site',
            'name' => 'get.manager-site',
            'uri' => '/company/manager-site',
            'show_sidebar' => 1,
            'menu' => [
                [
                    'title'        => 'Danh sách site',
                    'name'         => 'get.manager-site.index',
                    'uri'          => '/company/manager-site/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thêm site',
                    'name'         => 'get.manager-site.add',
                    'uri'          => '/company/manager-site/add',
                    'show_sidebar' => 1,
                ],
            ],
        ],
    ]
];


<?php
return [
    'company' => [
        [
            'title'        => 'Công ty',
            'name'         => 'get.company',
            'uri'          => '/company/company',
            'show_sidebar' => 1,
            'plugin'       => 'organization',
            'menu'         => [
                [
                    'title'        => 'Danh sách công ty',
                    'name'         => 'get.company.index',
                    'uri'          => '/company/company/index',
                    'plugin'       => 'organization',
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thêm mới công ty',
                    'name'         => 'get.company.create',
                    'uri'          => '/company/company/create',
                    'plugin'       => 'organization',
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Sửa công ty',
                    'name'         => 'get.company.edit',
                    'uri'          => '/company/company/edit',
                    'plugin'       => 'organization',
                    'show_sidebar' => 0,
                ],
                [
                    'title'        => 'Xóa công ty',
                    'name'         => 'get.company.delete',
                    'uri'          => '/company/company/delete',
                    'plugin'       => 'organization',
                    'show_sidebar' => 0,
                ],
            ]
        ],
        [
            'title'        => 'Phòng ban',
            'name'         => 'get.department',
            'uri'          => '/company/departments',
            'show_sidebar' => 1,
            'plugin'       => 'organization',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => 'get.department.index',
                    'uri'          => '/company/departments/index',
                    'show_sidebar' => 1,
                    'plugin'       => 'organization',
                ],
                [
                    'title'        => 'Thêm mới',
                    'name'         => 'get.department.create',
                    'uri'          => '/company/departments/create',
                    'show_sidebar' => 1,
                    'plugin'       => 'organization',
                ],
                [
                    'title'        => 'Sửa phòng ban',
                    'name'         => 'get.department.edit',
                    'uri'          => '/company/departments/edit',
                    'show_sidebar' => 0,
                    'plugin'       => 'organization',
                ],
            ]
        ],
    ]
];

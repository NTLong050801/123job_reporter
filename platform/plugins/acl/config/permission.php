<?php
return [
    'allow_route'=>[

    ],

    'company' => [
        [
            'title'        => 'Vai trò ',
            'name'         => 'get.role',
            'uri'          => '/company/roles',
            'show_sidebar' => 1,
            'plugin'       => 'acl',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => 'get.role.index',
                    'uri'          => '/company/roles/index',
                    'show_sidebar' => 1,
                    'plugin'       => 'acl',
                ]
            ]
        ],
        [
            'title'        => 'Phân quyền',
            'uri'          => '/company/permission',
            'name'         => 'get.permission',
            'show_sidebar' => 1,
            'plugin'       => 'acl',
            'menu'         => [
                [
                    'title'        => 'Danh sách quyền',
                    'uri'          => '/company/permission/index',
                    'name'         => 'get.permission.index',
                    'show_sidebar' => 1,
                    'plugin'       => 'acl',
                ],
                [
                    'title'        => 'Theo nhóm người dùng',
                    'uri'          => '/company/permission/assign-role',
                    'name'         => 'get.permission.assign_role',
                    'show_sidebar' => 1,
                    'plugin'       => 'acl',
                ],
                [
                    'title'        => 'Theo người dùng',
                    'uri'          => '/company/permission/assign-admin',
                    'name'         => 'get.permission.assign_admin',
                    'show_sidebar' => 1,
                    'plugin'       => 'acl',
                ]
            ]
        ],
    ],
];

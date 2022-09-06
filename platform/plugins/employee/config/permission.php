<?php
return [
    'company'     => [
        [
            'title'        => 'Nhân sự',
            'name'         => 'get.employee',
            'uri'          => '/company/employee',
            'show_sidebar' => 1,
            'plugin'       => 'employee',
            'menu'         => [
                [
                    'title'        => 'Danh sách tài khoản',
                    'name'         => 'get.employee.index',
                    'uri'          => '/company/employee/index',
                    "plugin"       => "employee",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Nhân sự đã nghỉ việc',
                    'name'         => 'get.employee.end',
                    'uri'          => '/company/employee/end',
                    "plugin"       => "employee",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thêm nhân sự',
                    'name'         => 'get.employee.create',
                    'uri'          => '/company/employee/create',
                    'show_sidebar' => 1,
                    'plugin'       => 'employee',
                ],
                [
                    'title'        => 'Sửa nhân sự',
                    'name'         => 'get.employee.edit',
                    'uri'          => '/company/employee/edit',
                    'show_sidebar' => 0,
                    'plugin'       => 'employee',
                ],
            ]
        ],
    ],
];

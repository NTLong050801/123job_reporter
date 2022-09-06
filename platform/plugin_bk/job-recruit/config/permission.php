<?php
return [
    'hrm'     => [
        [
            'title'        => 'Nhân sự',
            'name'         => 'get.employee',
            'uri'          => '/hrm/employee',
            'show_sidebar' => 1,
            "plugin"       => "employee",
            'menu'         => [
                [
                    'title'        => 'Danh sách tài khoản',
                    'name'         => 'get.employee.index',
                    'uri'          => '/hrm/employee/index',
                    "plugin"       => "employee",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Nhân sự đã nghỉ việc',
                    'name'         => 'get.employee.end',
                    'uri'          => '/hrm/employee/end',
                    "plugin"       => "employee",
                    'show_sidebar' => 1,
                ],
                [
                    'title'        => 'Thêm nhân sự',
                    'name'         => 'get.employee.create',
                    'uri'          => '/hrm/employee/create',
                    "plugin"       => "employee",
                    'show_sidebar' => 1,
                ]
            ]
        ],
    ],
];

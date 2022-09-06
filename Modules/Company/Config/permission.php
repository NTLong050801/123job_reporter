<?php

$plugins = setting('activated_plugins', '[]');
$allow_routes = [];

foreach ($plugins as $plugin => $status) {
    if ($status) {
        $plugin_allow = require(plugin_path($plugin) . '/config/permission.php');
        if (array_key_exists('allow_route', (array)$plugin_allow)) {
            $plugin_allow_route = $plugin_allow['allow_route'];
            $allow_routes = array_merge($allow_routes, $plugin_allow_route);
        }
    }
}

$permission = [
    'allow_route' => [
        'get.module.sort_data',
        'get.module.sort_update',
    ],
    'company' => [
        [
            'title' => 'Menu',
            'name' => 'get.menu',
            'uri' => '/company/menus',
            'show_sidebar' => 1,
            'menu' => [
                [
                    'title' => 'Danh sách',
                    'name' => 'get.menu.index',
                    'uri' => '/company/menus/index',
                    'show_sidebar' => 1,
                ],
            ]
        ],
        [
            'title' => 'Module',
            'name' => 'get.module',
            'uri' => '/company/modules',
            'show_sidebar' => 1,
            'menu' => [
                [
                    'title' => 'Danh sách module',
                    'name' => 'get.module.index',
                    'uri' => '/company/modules/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Sắp xếp module',
                    'name' => 'get.module.sort',
                    'uri' => '/company/modules/sort',
                    'show_sidebar' => 1,
                ]
            ]
        ],
    ],
    "profile" => [
        [
            'title' => 'Tài khoản',
            'name' => 'get.profile.show',
            'uri' => '/profile/index',
            'show_sidebar' => 1,
            'menu' => [],
        ],
        [
            'title' => 'Cập nhật mật khẩu',
            'name' => 'get.profile.change_password',
            'uri' => '/profile/change_password',
            'show_sidebar' => 1,
            'menu' => [],
        ],
        [
            'title' => 'Lịch sử hành động',
            'name' => 'get.profile.history',
            'uri' => '/profile/history',
            'show_sidebar' => 1,
            'menu' => [],
        ],
        [
            'title' => 'Lịch sử đăng nhập',
            'name' => 'get.profile.login-history',
            'uri' => '/profile/login-history',
            'show_sidebar' => 1,
            'menu' => [],
        ],
    ],
    "home" => [
        [
            'title' => 'Overview',
            'name' => 'get.overview',
            'uri' => '/home/overview',
            'show_sidebar' => 1,
            'menu' => [
                [
                    'title' => 'SEO Content',
                    'name' => 'get.seo_content.index',
                    'uri' => '/home/seo_content/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Reference',
                    'name' => 'get.reference.index',
                    'uri' => '/home/reference/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Robots',
                    'name' => 'get.robot.index',
                    'uri' => '/home/robot/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Upload/Public',
                    'name' => 'get.upload.index',
                    'uri' => '/home/upload/index',
                    'show_sidebar' => 1,
                ], [
                    'title' => 'Apply/Reference',
                    'name' => 'get.apply.index',
                    'uri' => '/home/apply/index',
                    'show_sidebar' => 1,
                ],
            ]
        ],
        [
            'title' => 'Report',
            'name' => 'get.report',
            'uri' => '/home/report',
            'show_sidebar' => 1,
            'menu' => [
                [
                    'title' => 'Monitor',
                    'name' => 'get.monitor.index',
                    'uri' => '/home/monitor/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'GA',
                    'name' => 'get.ga.index',
                    'uri' => '/home/ga/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Console',
                    'name' => 'get.console.index',
                    'uri' => '/home/console/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'Sitemap',
                    'name' => 'get.sitemap.index',
                    'uri' => '/home/sitemap/index',
                    'show_sidebar' => 1,
                ],
                [
                    'title' => 'PageSpeed',
                    'name' => 'get.pageSpeed.index',
                    'uri' => '/home/pageSpeed/index',
                    'show_sidebar' => 1,
                ]
            ]
        ],
    ]
];

$permission['allow_route'] = array_merge($permission['allow_route'], $allow_routes);
return $permission;

<?php
return [
    "setting" => [
        [
            'title'        => 'Thuộc tính',
            'name'         => 'get.attribute',
            'uri'          => '/setting/attribute',
            'show_sidebar' => 1,
            'plugin'       => 'attribute',
            'menu'         => [
                [
                    'title'        => 'Danh sách',
                    'name'         => 'get.attribute.list',
                    'uri'          => '/setting/attribute/index',
                    'show_sidebar' => 1,
                    'plugin'       => 'attribute',
                ],
                [
                    'title'        => 'Thêm mới',
                    'name'         => 'get.attribute.create',
                    'uri'          => '/setting/attribute/create',
                    'show_sidebar' => 1,
                    'plugin'       => 'attribute',
                ],
                [
                    'title'        => 'Lưu mới',
                    'name'         => 'post.adm_attr.store',
                    'uri'          => '/setting/attribute/store',
                    'show_sidebar' => 0,
                    'plugin'       => 'attribute',
                ],
                [
                    'title'        => 'Sửa thuộc tính',
                    'name'         => 'get.adm_attr.edit',
                    'uri'          => '/setting/attribute/edit',
                    'show_sidebar' => 0,
                    'plugin'       => 'attribute',
                ],
                [
                    'title'        => 'Cập nhật thuộc tính',
                    'name'         => 'post.adm_attr.edit',
                    'uri'          => '/setting/attribute/update',
                    'show_sidebar' => 0,
                    'plugin'       => 'attribute',
                ],
                [
                    'title'        => 'Cập nhật trạng thái',
                    'name'         => 'get.adm_attr.status',
                    'uri'          => '/setting/attribute/status',
                    'show_sidebar' => 0,
                    'plugin'       => 'attribute',
                ],
            ]
        ],
    ]
];

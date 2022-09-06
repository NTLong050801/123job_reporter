<?php
return [
    'banner'    => [
        'extensions'     => ['jpg', 'jpeg', 'png','gif'],
        'file_size'      => 1024 * 3,
        'upload_folder'  => 'uploads',
        'check_resize'      => 0,
    ],
    'logo'     => [
        'extensions'     => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        'file_size'      => 300,
        'upload_folder'  => 'uploads',
        'check_resize'      => 0,
        'thumbs'          => [
            'sm_' => ['width' => 320, 'height' => 240],
            'md_' => ['width' => 480, 'height' => 360],
        ]
    ],
    'attach'    => [
        'extensions'     => ['jpg', 'jpeg', 'png','gif'],
        'file_size'      => 1024 * 3,
        'upload_folder'  => 'uploads',
        'check_resize'      => 0,
    ],
    'thumbnail'    => [
        'extensions'     => ['jpg', 'jpeg', 'png'],
        'file_size'      => 1024,
        'upload_folder'  => 'uploads',
        'check_resize'      => 0,
    ],
    'avatar'    => [
        'extensions'     => ['jpg', 'jpeg', 'png'],
        'file_size'      => 1024,
        'upload_folder'  => 'uploads',
        'check_resize'      => 0,
    ],
];

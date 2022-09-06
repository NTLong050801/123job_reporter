<?php

return [
    // Các file được phép upload
    'extensions'    => ['gif', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'pdf', 'bmp', 'js', 'css', 'webp'],
    'file_size'     => 2048,
    'upload_folder' => 'uploads',
    'static_url'    => env('URL_STATIC_FILE', 'http://admin.timnha247.abc/'),
    'default'       => env('DRIVER_UPLOAD', 'local'),
    'driver'        => [
        'local' => [
            'name'             => 'local',
            'driver'           => 'local',
            'root'             => base_path(),
            'path'             => public_path()
        ],
        'minio'   => [
            'name'                    => 'minio',
            'driver'                  => 's3',
            'use_path_style_endpoint' => true,
            'key'                     => env('AWS_ACCESS_KEY_ID'),
            'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
            'region'                  => env('AWS_DEFAULT_REGION'),
            'bucket'                  => env('AWS_BUCKET', 'minio'),
            'url'                     => env('AWS_URL', 'http://localhost:9000'),
            'endpoint'                => env('AWS_ENDPOINT', 'http://localhost:9000'),
            'path'                    => '',
            'root'                    => '/'
        ],
    ]
];

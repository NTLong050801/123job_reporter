<?php

return [
    'max_file_size' => 52428800, // size in Byte
    'pattern'       => env('LOGVIEWER_PATTERN', '*.log'),
    'admin' => [
        'storage_path'  => storage_path('logs'),
    ],
    'main' => [
        'storage_path'  => '/var/www/timnha247.abc/timnha247_main/storage/logs',
    ],
];

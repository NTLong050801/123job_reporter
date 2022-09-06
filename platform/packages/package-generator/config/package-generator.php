<?php
return [
    'package_namespace' => 'Workable', // Tên vendor
    "package_platform" => "analyzer", // Folder chứa các package
    "stubs" => [
        'enabled' => false,
    ],
    "generator" => [
        'config' => ['path' => 'Config', 'generate' => true],
        'command' => ['path' => 'Console', 'generate' => true],
        'migration' => ['path' => 'Database/Migrations', 'generate' => true],
        'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
        'factory' => ['path' => 'Database/factories', 'generate' => true],
        'model' => ['path' => 'Models', 'generate' => true],
        'routes' => ['path' => 'Routes', 'generate' => true],
        'controller' => ['path' => 'Http/Controllers', 'generate' => true],
        'filter' => ['path' => 'Http/Middleware', 'generate' => true],
        'request' => ['path' => 'Http/Requests', 'generate' => true],
        'provider' => ['path' => 'Providers', 'generate' => true],
        'assets' => ['path' => 'Resources/assets', 'generate' => true],
        'lang' => ['path' => 'Resources/lang', 'generate' => true],
        'views' => ['path' => 'Resources/views', 'generate' => true],
        'test' => ['path' => 'Tests/Unit', 'generate' => true],
        'test-feature' => ['path' => 'Tests/Feature', 'generate' => true],
        'repository' => ['path' => 'Repositories', 'generate' => false],
        'event' => ['path' => 'Events', 'generate' => false],
        'listener' => ['path' => 'Listeners', 'generate' => false],
        'policies' => ['path' => 'Policies', 'generate' => false],
        'rules' => ['path' => 'Rules', 'generate' => false],
        'jobs' => ['path' => 'Jobs', 'generate' => false],
        'emails' => ['path' => 'Emails', 'generate' => false],
        'notifications' => ['path' => 'Notifications', 'generate' => false],
        'resource' => ['path' => 'Transformers', 'generate' => false],
    ],
    'composer' => [
        'vendor' => 'hungokata',
        'author' => [
            'name' => 'Hungokata',
            'email' => 'Hungokata630@gmail.com',
        ],
    ],
];

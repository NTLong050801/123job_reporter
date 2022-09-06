<?php
return [
    'package_namespace' => 'Workable', // Tên vendor
    "package_platform" => "test", // Folder chứa các package
    "package_work" => "test", // Package thao tác chạy command,
    'enum_default' => [
        'status'
    ], // active enum default when create enum if empty
    "stubs" => [
        "view_list" => [
            "index", "create", "edit", "form", "show", "delete"
        ],
        'enabled' => false,
        "enum" => [
            "status" => "stubs/Enum/StatusEnum.stub",
            "type" => "stubs/Enum/TypeEnum.stub",
        ],
        "controller_api" => "stubs/Http/Controllers/ApiController.stub",
        "controller" => "stubs/Http/Controllers/Controller.stub",
        "service" => "stubs/Services/NameService.stub",
        "repository" => "stubs/Repository/NameRepository.stub",
        "model" => "stubs/Model/NameModel.stub",
        "request" => "stubs/Request/NameRequest.stub",
        "console" => "stubs/Command/NameConsole.stub",
        "route" => [
            "web" => "stubs/Route/api.stub",
            "api" => "stubs/Route/web.stub",
        ]
    ],
    'customStubs' => true,
    'stringTypes' => [
        'char', 'string', 'text', 'mediumText', 'longText', 'json', 'jsonb',
    ],
    'integerTypes' => [
        'increments', 'integerIncrements', 'tinyIncrements', 'smallIncrements', 'mediumIncrements', 'bigIncrements',
        'integer', 'tinyInteger', 'smallInteger', 'mediumInteger', 'bigInteger',
        'unsignedInteger', 'unsignedTinyInteger', 'unsignedSmallInteger', 'unsignedMediumInteger', 'unsignedBigInteger',
    ],
    'floatTypes' => [
        'float', 'double', 'decimal', 'unsignedDecimal',
    ],
    'dateTypes' => [
        'date', 'dateTime', 'dateTimeTz',
        'time', 'timeTz', 'timestamp', 'timestampTz', 'timestamps',
        'timestamps', 'timestampsTz', 'softDeletes', 'softDeletesTz',
        'year',
    ],
    'bluePrintTypes' => [
        'increments', 'integerIncrements', 'tinyIncrements', 'smallIncrements', 'mediumIncrements', 'bigIncrements',
        'char', 'string', 'text', 'mediumText', 'longText',
        'integer', 'tinyInteger', 'smallInteger', 'mediumInteger', 'bigInteger',
        'unsignedInteger', 'unsignedTinyInteger', 'unsignedSmallInteger', 'unsignedMediumInteger', 'unsignedBigInteger',
        'float', 'double', 'decimal', 'unsignedDecimal',
        'boolean',
        'enum', 'set',
        'json', 'jsonb',
        'date', 'dateTime', 'dateTimeTz',
        'time', 'timeTz', 'timestamp', 'timestampTz', 'timestamps',
        'timestamps', 'timestampsTz', 'softDeletes', 'softDeletesTz',
        'year',
        'binary',
        'uuid',
        'ipAddress',
        'macAddress',
        'geometry', 'point', 'lineString', 'polygon', 'geometryCollection', 'multiPoint', 'multiLineString', 'multiPolygon', 'multiPolygonZ',
        'computed',
        'morphs', 'nullableMorphs', 'uuidMorphs', 'nullableUuidMorphs',
        'rememberToken',
        'foreign',
    ],
    "generator" => [
        'config' => ['path' => 'Config', 'generate' => true],
        'command' => ['path' => 'Console', 'generate' => true],
        'migration' => ['path' => 'Database/Migrations', 'generate' => true],
        'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
        'factory' => ['path' => 'Database/factories', 'generate' => true],
        'model' => ['path' => 'Models', 'generate' => true],
        'routes' => ['path' => 'routes', 'generate' => true],
        'controller' => ['path' => 'Http/Controllers', 'generate' => true],
        'filter' => ['path' => 'Http/Middleware', 'generate' => true],
        'request' => ['path' => 'Http/Requests', 'generate' => true],
        'provider' => ['path' => 'Providers', 'generate' => true],
        'assets' => ['path' => 'resources/assets', 'generate' => true],
        'lang' => ['path' => 'resources/lang', 'generate' => true],
        'views' => ['path' => 'resources/views/backend', 'generate' => true],
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
    "layout" => "admin::layouts.master",
    "content" => "content",
    "script" => false,
];

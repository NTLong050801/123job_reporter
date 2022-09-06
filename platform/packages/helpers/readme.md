#About
Thư viện helper giúp quá trình xử lý dự án phát triển nhanh hơn
Nạp vào composer.json

```
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "classmap": [
        "platform/packages/helpers/classes"
    ],
    "files": [
        "platform/packages/helpers/autoload.php"
    ]
},

```
After run command root project
``` 
php composer dump-autoload
```


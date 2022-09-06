Laravel package generator
=========================
Simple package to quickly generate basic structure for other laravel packages.

## Install
Install via terminal 
```bash
# add submodule
git submodule add git@gitlab.com:workable_packages/package-generator.git platform/package-generator

# composer
composer require --dev workable/package-generator
```

Publish package config if you want customize default values
```bash
php artisan vendor:publish --provider="Workable\PackageGenerator\PackageGeneratorServiceProvider" --tag="config"
```

## Setup
``` Setup in composer.json
"repositories": [
        {
            "type": "path",
            "url": "./platform/yourname/*",
            "options": {
                "symlink": true
            }
        }
    ]
```

## Các comamnd sẵn sàng trên hệ thống
``` shell script
# Support command for web
[x]package:create            "Create a or many new package"
[x]package:del               "Delete a or many package"
[x]package-make:migration   "Create a new migration class and apply schema at the same time"
[x]package-make:model       "Create a new model class and apply schema at the same time"
[x]package-make:request     "Create a new requests class and apply schema at the same time"
[x]package-make:controller  "Create a new controller and resources for api"
[x]package-make:route       "Insert new resources routes"
[x]package-make:service     "Create a new service"
[x]package-make:seed        "Create a new Seeder"
[x]package-make:middleware  "Create a new Middleware"
[x]package-make:repository  "Create a new Repository"
[x]package-make:console     "Create a new Console"
[x]package-make:enum        "Create a new Enum"

[]package-make:event        "Create a event"
[]package-make:listener     "Create a listener"
[]package-make:lang         "Create a new lang resource and apply schema at the same time"
[]package-make:nav          "Insert new nav item"
[]package-make:view         "Create a new views resource and apply schema at the same time"
[]package-make:crud         "Run all commands"

# Support command for api
[]package-make:resources    "Create a new resources class and apply schema at the same time"
[]package-make:transform    "Create a new transform"
[]package-make:response     "Create a new response"

# Support command for all
[]package-make:test         "Create a new feature test and apply schema at the same time"
[]package-make:factory      "Create a new factory class and apply schema at the same time"

```

### php artisan package:create -i {vendor} {package}

Tọa 1 hoặc nhiều package

Example: `php artisan package:create Post Tag --platform=packages`

This command will:
* Create two package: `Post` và `Tag`
* flag `platform`: tạo 2 package trong thư mục: `packages`. Có thể đổi tên
* Register package in app composer.json
* Run `git init packages/some-awesome-package`
* Run `composer update jimmea/some-awesome-package`
* Run `composer dump-autoload`


### php artisan package:del {package}
Xóa một package khỏi hệ thống

Example: `php artisan package:del Package1 Package2`

This command will:

* Run `composer remove packages1 package2`
* Remove folder contains `Package1` `Package2` with options `--platform`
* Unregister package in app composer.json
* Run `composer dump-autoload`


## Reference
- [Alexander Melihov](https://github.com/melihovv/laravel-package-generator)
- [Laravel-5-Generators-Extended](https://github.com/laracasts/Laravel-5-Generators-Extended)
- [laravel-package-generator](https://github.com/srmklive/laravel-package-generator)
- [lpackager](https://github.com/amranidev/lpackager)
- [Laravel-Oh-Generators](https://github.com/Mombuyish/Laravel-Oh-Generators)
- [laravelha/generator](https://github.com/laravelha/generator)
- [Laravel-Backpack/Generators](https://github.com/Laravel-Backpack/Generators)

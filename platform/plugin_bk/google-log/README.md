# Google Log

[![Build Status](https://travis-ci.org/workable/google-log.svg?branch=master)](https://travis-ci.org/workable/google-log)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)
[![Coverage Status](https://coveralls.io/repos/github/workable/google-log/badge.svg?branch=master)](https://coveralls.io/github/workable/google-log?branch=master)

[![Packagist](https://img.shields.io/packagist/v/workable/google-log.svg)](https://packagist.org/packages/workable/google-log)
[![Packagist](https://poser.pugx.org/workable/google-log/d/total.svg)](https://packagist.org/packages/workable/google-log)
[![Packagist](https://img.shields.io/packagist/l/workable/google-log.svg)](https://packagist.org/packages/workable/google-log)

Package description: CHANGE ME

## Installation

Install via composer
```bash
composer require workable/google-log
```

### Publish Configuration File

```bash
php artisan vendor:publish --provider="Workable\GoogleLog\GoogleLogServiceProvider" --tag="config"
```

# Run command
- Command chạy lấy dữ liệu google analytic vs google tag manager
```
 # Lấy GA
 php artisan google-log:get-data-ga-user --start_date=2021-06-01 --end_date=2021-06-30
 

 # Lấy các event được setting trong config
 php artisan client-event:get-data-ga-event --start_date=2021-06-01 --end_date=2021-06-30
```
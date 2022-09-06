# Audit Log

[![Build Status](https://travis-ci.org/workable/audit-log.svg?branch=master)](https://travis-ci.org/workable/audit-log)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)
[![Coverage Status](https://coveralls.io/repos/github/workable/audit-log/badge.svg?branch=master)](https://coveralls.io/github/workable/audit-log?branch=master)

[![Packagist](https://img.shields.io/packagist/v/workable/audit-log.svg)](https://packagist.org/packages/workable/audit-log)
[![Packagist](https://poser.pugx.org/workable/audit-log/d/total.svg)](https://packagist.org/packages/workable/audit-log)
[![Packagist](https://img.shields.io/packagist/l/workable/audit-log.svg)](https://packagist.org/packages/workable/audit-log)

Package description: CHANGE ME

## Installation

Install via composer
```bash
composer require workable/audit-log
```

### Publish Configuration File

```bash
php artisan vendor:publish --provider="Workable\AuditLog\AuditLogServiceProvider" --tag="config"
```

## Usage
```
    # Call via event of core
    event(new UpdatedContentEvent("employee", $request, $employee));

    # Call qua facade of plugin: audit-log/src/AuditLog.php
     AuditLog::screen("employee")
                ->request($request)
                ->data($employee)
                ->updated();
```

## Security

If you discover any security related issues, please email
instead of using the issue tracker.

## Credits
- [Link](https://github.com/workable/audit-log)
- [All contributors](https://github.com/workable/audit-log/graphs/contributors)

## Tài liệu tham khảo
- [Xây dựng hệ thống Log cho Microservices](http://bloghoctap.com/technology/xay-dung-he-thong-log-cho-microservices.html)

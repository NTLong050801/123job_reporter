# Tạo class Enum
Để tạo một class `Enum` thì chúng ta sử dụng.

```
php artisan package-make:enum Contact --package=contact --platform=plugins --enum=status
```

**Ghi chú:**
- `--package`: Chỉ ra rằng class `Contact` sẽ được tạo trong package `contact`.
- `--platform`: Chỉ ra rằng sẽ được tạo trong thư mục nào. Hiện tại đang ở thư mục `platform/plugins`
- `--enum`: Chỉ ra rằng render enum theo format được thiết lập. Support: `status`, `type`


**Kết quả nhận được**
```
<?php
namespace Workable\Contact\Enum;

class ContactStatusEnum
{
    const STATUS_ACTIVE    = 1;
    const STATUS_INACTIVE  = 0;

    public static $statusText = [
        0 => [
            'name' => 'Không hoạt động',
            'class' => 'label label-danger'
        ],
        1 => [
            'name' => 'Hoạt động',
            'class' => 'label label-success'
        ]
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<span class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

```

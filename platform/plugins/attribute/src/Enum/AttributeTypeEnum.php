<?php
namespace Workable\Attribute\Enum;

class AttributeTypeEnum
{
    const TYPE_SALARY = 1;
    const TYPE_LEVEL = 2;
    const TYPE_WORK_TYPE = 3;
    const TYPE_LITERACY = 4;
    const TYPE_EXP = 5;
    const TYPE_LANGUAGE = 6;
    const TYPE_BENEFIT = 7;

    public static $statusText = [
        1 => [
            'name' => 'Mức lương',
            'class' => 'label label-default'
        ],
        2 => [
            'name' => 'Cấp bậc',
            'class' => 'label label-info'
        ],
        3 => [
            'name' => 'Hình thức làm việc',
            'class' => 'label label-info'
        ],
        4 => [
            'name' => 'Trình độ',
            'class' => 'label label-info'
        ],
        5 => [
            'name' => 'Kinh nghiệm',
            'class' => 'label label-info'
        ],
        6 => [
            'name' => 'Ngôn ngữ',
            'class' => 'label label-info'
        ],
        7 => [
            'name' => 'Phúc lợi',
            'class' => 'label label-info'
        ],
    ];

    public static function status($status)
    {
        $statusItem = self::$statusText[$status];
        return '<label class="'. $statusItem['class'] .'">'. $statusItem['name'] .'</label>';
    }
}

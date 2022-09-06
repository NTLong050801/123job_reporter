<?php


namespace Workable\AuditLog\Enum;


class ActivityAgentEnum
{
    const AGENT_CHROME  = 'chrome';
    const AGENT_LINUX   = 'linux';
    const AGENT_OS_X    = 'os x';
    const AGENT_WIN     = 'windows';

    public static $actionText = [
        self::AGENT_CHROME => [
            'name' => 'Chrome',
            'icon' => '<i class="fa fa-chrome"></i>'
        ],
        self::AGENT_LINUX => [
            'name' => 'Linux',
            'icon' => '<i class="fa fa-linux"></i>'
        ],
        self::AGENT_OS_X => [
            'name' => 'MACOS',
            'icon' => '<i class="fa fa-linux"></i>'
        ],
        self::AGENT_WIN => [
            'name' => 'Window',
            'icon' => '<i class="fa fa-windows"></i>'
        ],
    ];

    public static function status($status)
    {
//        $textStatus = mb_strtolower($status);
//        $statusItem = self::$actionText[$textStatus];
//
        return $status;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 10:53 AM
 */

namespace Workable\GoogleLog\Enum;

class ClientEventEnum
{
    const APP_123JOB = 1;
    const APP = [
        self::APP_123JOB => '123job'
    ];

    const EVENT_CLICK_SUBSCRIBE_JOB = 1;
    const EVENT_OPEN_SUBSCRIBE_JOB  = 2;
    const EVENT_CLICK_OPEN_APPLY    = 3;

    const EVENT = [
        self::EVENT_CLICK_SUBSCRIBE_JOB => 'click_subscribe_job',
        self::EVENT_OPEN_SUBSCRIBE_JOB  => 'open_subscribe_job',
        self::EVENT_CLICK_OPEN_APPLY    => 'click_open_apply',
    ];

    const LABEL_PAGE_JOB  = 'job';
    const LABEL_PAGE_BLOG = 'blog';
}
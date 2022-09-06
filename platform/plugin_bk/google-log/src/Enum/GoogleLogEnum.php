<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 10:53 AM
 */

namespace Workable\GoogleLog\Enum;

class GoogleLogEnum
{
    const APP_123JOB = 1;
    const APP = [
        self::APP_123JOB => '123job'
    ];

    const LOG_USER        = 1;
    const LOG_SESSION     = 2;
    const LOG_PAGE_VIEW   = 3;
    const LOG_BOUNCE_RATE = 4;
    const LOG_NEW_USER    = 5;

    const LOG = [
        self::LOG_USER        => 'ga_user',
        self::LOG_SESSION     => 'ga_session',
        self::LOG_PAGE_VIEW   => 'ga_page_view',
        self::LOG_BOUNCE_RATE => 'ga_bounce_rate',
        self::LOG_NEW_USER    => 'ga_new_user',
    ];

    const LABEL_PAGE_JOB  = 'job';
    const LABEL_PAGE_BLOG = 'blog';
}
<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 10:53 AM
 */

namespace Workable\RobotLog\Enum;

class RobotVisitEnum
{
    const APP_123JOB = 1;
    const APP = [
        self::APP_123JOB => '123job'
    ];

    const LABEL_PAGE_JOB  = 'job';
    const LABEL_PAGE_BLOG = 'blog';

    const COUNT_INIT = 0;
    const COUNT_DONE = 1;
}
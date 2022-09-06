<?php
/**
 * Created by PhpStorm.
 * User: dinhhuong
 * Date: 4/9/21
 * Time: 3:47 PM
 */

namespace Workable\Candidate\Enum;

class CandidateEnum
{
    const SOURCE_APPLY     = 0;
    const SOURCE_FEED      = 1;
    const SOURCE_CHOTOT    = 2;
    const SOURCE_MUABAN    = 3;
    const SOURCE_USER_INFO = 4;
    const SOURCE_CV_USER   = 5;
    const SOURCE_CV_MYJOB   = 6;
    const SOURCE_CV_SPIDER   = 7;

    const SOURCE = [
        self::SOURCE_APPLY     => 'apply',
        self::SOURCE_FEED      => 'feed',
        self::SOURCE_CHOTOT    => 'chotot',
        self::SOURCE_MUABAN    => 'muaban',
        self::SOURCE_USER_INFO => 'user_info',
        self::SOURCE_CV_USER   => 'cv_user',
        self::SOURCE_CV_MYJOB  => 'cv_myjob',
        self::SOURCE_CV_SPIDER  => 'cv_spider',
    ];
}


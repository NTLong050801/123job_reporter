<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/08 - 10:00
 */
namespace Workable\ReferenceSite\Enum;

class JobReferEnum
{
    const STATUS_ANALYST_INIT = 0;
    const STATUS_ANALYST_DONE = 1;

    const STATUS_REPORT_INIT = 0;
    const STATUS_REPORT_DONE = 1;

    const PROVIDER_SITE     = "Site";
    const PROVIDER_SOCIAL   = "Social";
    const PROVIDER_NA       = "N\A";

    const PROVIDER_ARRAY_TEXT = [
        0 => self::PROVIDER_SITE,
        1 => self::PROVIDER_NA,
        2 => self::PROVIDER_SOCIAL
    ];

    const ATTRIBUTE_PROVIDER = 1;
    const ATTRIBUTE_CITY     = 2;
    const ATTRIBUTE_CATEGORY = 3;
    const ATTRIBUTE_SALARY   = 4;

}
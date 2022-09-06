<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/12 - 16:19
 */
namespace Workable\ApplyJob\Enum;

class ApplyJobEnum
{
    const STATUS_ANALYST_INIT = 0;
    const STATUS_ANALYST_DONE = 1;

    const STATUS_REPORT_INIT = 0;
    const STATUS_REPORT_DONE = 1;

    const PROVIDER_SITE = "SOURCE_SITE";
    const PROVIDER_SOCIAL = "SOURCE_SOCIAL";

    const PROVIDER_ARRAY_TEXT = [
        0 => self::PROVIDER_SITE,
        1 => self::PROVIDER_SOCIAL
    ];

    const ATTRIBUTE_PROVIDER = 1;
    const ATTRIBUTE_CITY     = 2;
    const ATTRIBUTE_CATEGORY = 3;
    const ATTRIBUTE_SALARY   = 4;
}
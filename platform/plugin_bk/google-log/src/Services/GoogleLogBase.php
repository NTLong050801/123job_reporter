<?php
/**
 * Created by PhpStorm.
 * User: ThaiLe
 * Date: 17/06/2021
 * Time: 3:42 PM
 */

namespace Workable\GoogleLog\Services;

use Workable\GoogleLog\Utils\GoogleLogReportUtil;

abstract class GoogleLogBase
{
    /**
     * @var GoogleLogReportUtil
     */
    protected $googleLogReportUtil;

    public function __construct()
    {
        $this->googleLogReportUtil = new GoogleLogReportUtil();
    }
}
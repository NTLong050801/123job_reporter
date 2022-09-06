<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/09 - 12:26
 */

namespace Workable\ReferenceSite\Services;

use Workable\ReferenceSite\Utils\ReferSiteReportUtil;

abstract class JobReportReferBase
{
    /**
     * @var ReferSiteReportUtil
     */
    protected $referSiteReportUtil;

    public function __construct()
    {
        $this->referSiteReportUtil = new ReferSiteReportUtil();
    }
}
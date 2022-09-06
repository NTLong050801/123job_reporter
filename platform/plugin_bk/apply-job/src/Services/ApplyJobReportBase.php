<?php
/**
 * Created by PhpStorm.
 * User: Hungokata
 * Date: 2021/06/13 - 09:36
 */

namespace Workable\ApplyJob\Services;


use Workable\ApplyJob\Utils\ApplyReportUtil;

class ApplyJobReportBase
{
    /**
     * @var ApplyReportUtil
     */
    protected $applyReportUtil;

    public function __construct()
    {
        $this->applyReportUtil = new ApplyReportUtil();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 05/07/2022
 * Time: 10:52
 */

namespace Modules\Collect\Core\Entity;

use Modules\Collect\Core\Contracts\ProcessDataAbstract;
use Modules\Report\Services\ReportSeoService;

class SeoContentProcess extends ProcessDataAbstract
{
    private $reportSeoService;
    public function __construct()
    {
        $this->reportSeoService = app(ReportSeoService::class);
    }

    public function process($items = [])
    {
        return $this->reportSeoService->insertOrUpdateData($this->country, $items);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: TranLuong
 * Date: 05/07/2022
 * Time: 10:52
 */

namespace Modules\Collect\Core\Entity;

use Modules\Collect\Core\Contracts\ProcessDataAbstract;
use Modules\Report\Services\UploadService;

class UploadPublicProcess extends ProcessDataAbstract
{
    private $uploadService;

    public function __construct()
    {
        $this->uploadService = app(UploadService::class);
    }


    public function process($items = [])
    {
        $this->uploadService->insertOrUpdateData($this->country, $items);
    }
}

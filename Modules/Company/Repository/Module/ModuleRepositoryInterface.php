<?php


namespace Modules\Company\Repository\Module;


interface ModuleRepositoryInterface
{
    public function list($filter=false, $fields=['*'], $paginate = 20);

    public function updateModuleOrder($order);
}

<?php


namespace Modules\Company\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Company\Repository\Menu\MenuRepositoryInterface;
use Modules\Company\Repository\Module\ModuleRepositoryInterface;

class ModuleService
{
    protected $moduleRepository, $menuRepository;

    public function __construct(ModuleRepositoryInterface $moduleRepository, MenuRepositoryInterface $menuRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->menuRepository   = $menuRepository;
    }

    public function list($filter = false)
    {
        $items = $this->moduleRepository->list($filter);
        return $items;
    }

    public function find($id)
    {
        return $this->moduleRepository->find($id);
    }
    public function update($id, $data)
    {
        $this->moduleRepository->update($id, $data);
    }
    public function listMenu()
    {
        $filter = [['menu_status', '=', 1]];
        return $this->menuRepository->getAll($filter, false, false, ["*"]);
    }

    public function updateModuleOrder($order)
    {
        $this->moduleRepository->updateModuleOrder($order);
        Cache::flush();
    }
}

<?php

namespace Modules\Company\Repository\Module;

use Modules\Company\Models\Module;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    protected $model;
    public function __construct(Module $menu)
    {
        $this->model = $menu;
    }

    public function list($filter = false, $fields = ['*'], $paginate = 20)
    {
        $query = $this->model::with('admin');
        $query = $this->scopeFilter($query, $filter);
        $items = $query->orderBy('sort', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        return $items;
    }

    public function updateModuleOrder($order)
    {
        // dump($order);
        $length = sizeof($order);
        $query  = $this->model;
        foreach ($order as $key => $value) {
            $query::where('id', $value)->update(['sort' => $length - $key]);
        };
    }
}

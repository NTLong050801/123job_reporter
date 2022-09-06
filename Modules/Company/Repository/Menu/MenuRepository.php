<?php

namespace Modules\Company\Repository\Menu;

use Modules\Company\Enum\MenuStatusEnum;
use Modules\Company\Models\Menu;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    protected $model;

    public function __construct(Menu $menu)
    {
        $this->model = $menu->whereRaw(1);
    }

    // lấy ra tất cả các bản ghi trong menu
    public function list($filter, $fields = ['*'], $paginate = [])
    {
        $query = $this->model;
        // $query = $this->model->whereRaw('1=1');
        $query = $this->scopeFilter($query, $filter);
        $items = $query->orderBy('menu_sort', 'asc')
            ->get();
        return $items;
    }

    public function listMenuByPermission($menus_id)
    {
        $query = $this->model;
        $items = $query->whereIn('id', $menus_id)
            ->orderBy('menu_sort', 'asc')
            ->get();
        return $items;
    }

    public function findOneBySlug($slug)
    {
        return $this->model->where('menu_slug', $slug)->first();
    }

    public function firstById($id,$column =['*'])
    {
        return $this->findById($id);
    }

    public function delete($id)
    {
        return $this->update($id, ['menu_status' => MenuStatusEnum::STATUS_DELETE]);
    }

    public function insertData($data)
    {
        $data['menu_status'] = (int)$data['menu_status'];
        $data['created_at']  = now();
        $data['updated_at']  = now();
        return $this->insert($data);
    }

    public function incrementHit($menuId, $column)
    {
        return $this->increment($menuId, $column);
    }
}

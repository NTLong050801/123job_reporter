<?php


namespace Modules\Company\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Company\Repository\Menu\MenuRepositoryInterface;
use Workable\Acl\Repository\Permission\PermissionRepositoryInterface;
use Workable\Employee\Models\Admin;
use Workable\Employee\Traits\CacheTrait;

class MenuService
{
    use CacheTrait;

    protected $menuRepository, $permissionRepository;

    public function __construct(MenuRepositoryInterface $menuRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->menuRepository       = $menuRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function list($param = [])
    {
        $items = $this->menuRepository->list($param);
       return $items;
        //dd($items);
    }

    public function getListMenuVisible($param = [])
    {

        $user      = Admin::user();
        $cache_key = $this->makeKeyCache('admin_menu', $user->id);
        if ($user->isAdministrator()) {
            // dd(1);
            return Cache::remember($cache_key, 60, function () {
                $filter = [
                    ['menu_status', '=', 1]
                ];
                $items  = $this->menuRepository->list($filter);
                return $items;
            });
        }

        $permission_all = $user->cachedPermissions();
        $menu_arr       = array_keys($permission_all->groupBy('menu_id')->toArray());

        return Cache::remember($cache_key, 60, function () use ($menu_arr) {
            $items = $this->menuRepository->listMenuByPermission($menu_arr);
            return $items;
        });
    }

    public function first($slug)
    {
        return $this->menuRepository->findOneBySlug($slug);
    }

    public function firstById($id)
    {
        return $this->menuRepository->find($id);
    }

    public function delete($id)
    {
        return $this->menuRepository->delete($id);
    }

    public function insert($data)
    {
        return $this->menuRepository->insertData($data);
    }

    public function update($id, $data)
    {
        $item = $this->permissionRepository->findBy([
            'filter'=>[['uri', 'LIKE', '%'.$data['menu_link'].'%']]
        ]);
        // dd($item);
        if($item){
            $data['menu_route_name'] = $item->name;
        }
        $this->menuRepository->update($id, $data);
        // Cache::flush();
    }

    public function incrementMenuHit($menuId)
    {
        return $this->menuRepository->incrementHit($menuId, 'menu_menu_hit');
    }
}

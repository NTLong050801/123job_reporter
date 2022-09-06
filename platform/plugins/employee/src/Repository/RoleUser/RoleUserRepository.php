<?php
namespace Workable\Employee\Repository\RoleUser;

use Workable\Acl\Enum\RoleEnum;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\Role;
use Workable\Employee\Enum\AdminEnum;
use Workable\Employee\Models\AdminRoleUser;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class RoleUserRepository extends BaseRepository implements RoleUserRepositoryInterface
{
    protected $model;
    protected $param=[];

    public function __construct(AdminRoleUser $model)
    {
        $this->model = $model;
    }

    /**
    * Get list
    * @param array $filter
    * @param array $field
    * @param int $paginate
    * @return mix;
    */
    public function list($filter=false, $sort=false, $paginate=false)
    {
        $query = $this->model->with('admin:id,name');
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeFilter($query, $sort);
        // $items = $query->paginate($paginate);
        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    // public function updateRoleUser($id, $roles_user_inactive, $roles_user_active, $roles_user_insert)
    // {
    //     // dd($roles_user_inactive, $roles_user_active, $roles_user_insert);
    //     if (!empty($roles_user_insert)) {
    //         if ($roles_user_insert[0]['role_id'] == RoleEnum::SUPER_ADMIN_ID) {
    //             Permission::where('id', '<>', '0')->increment('number_user', 1);
    //             Role::where('id', 1)->increment('number_user', 1);
    //         } else {
    //             foreach ($roles_user_insert as $item) {
    //                 $this->id = $item['role_id'];
    //                 Permission::whereHas('roles', function ($query) {
    //                     $query->where('role_id', $this->id);
    //                 })->increment('number_user', 1);
    //                 Role::where('id', $item['role_id'])->increment('number_user', 1);
    //             }
    //         }
    //     }
    //     if (!empty($roles_user_active)) {
    //         $check = $this->model->where([['admin_id', $id], ['role_id', 1], ['active', 0]])->count();
    //         if ($roles_user_active[0] == 1 && $check) {
    //             // dd($check);
    //             Permission::where('id', '<>', '0')->increment('number_user', 1);
    //             Role::where('id', 1)->increment('number_user', 1);
    //         } else {
    //             // dd($roles_user_active);
    //             foreach ($roles_user_active as $item) {
    //                 $this->id = $item;
    //                 // dd(Permission::with('roleUser')->whereHas('roleUser', function ($query) {
    //                 //     $query->where('role_id', $this->id)->where('roleUser.active', 0);
    //                 // })
    //                 // ->get());
    //                 Permission::whereHas('roleUser', function ($query) {
    //                     $query->where('admin_role_user.role_id', $this->id)->where('admin_role_user.active', 0);
    //                 })->increment('number_user', 1);
    //                 Role::whereHas('roleUser', function($q)
    //                 {
    //                     $q->where('active','=', 0);
                    
    //                 })->where('id', $item)->increment('number_user', 1);
    //             }
    //         }
    //     }
    //     if (!empty($roles_user_inactive)) {
    //         if ($roles_user_inactive[0] == 1) {
    //             $check = $this->model->where([['admin_id', $id], ['role_id', 1], ['active', 1]])->count();
    //             if($check){
    //                 Permission::where('id', '<>', '0')->decrement('number_user', 1);
    //                 Role::where('id', 1)->decrement('number_user', 1);
    //             }
    //         }
    //         foreach ($roles_user_inactive as $item) {
    //             if($item != 1){
    //                 // dd($item);
    //                 $this->id = $item;
    //                 Permission::whereHas('roleUser', function ($query) {
    //                     $query->where('admin_role_user.role_id', $this->id)->where('admin_role_user.active', 1);
    //                 })->decrement('number_user', 1);
    //                 Role::whereHas('roleUser', function($q)
    //                 {
    //                     $q->where('active','=', 1);
    //                 })->where('id', $item)->decrement('number_user', 1);
    //             }
    //         }
    //     }
    //     $this->model->whereIn('role_id', $roles_user_inactive)->where('admin_id', $id)->update(['active' => 0]);
    //     $this->model->whereIn('role_id', $roles_user_active)->where('admin_id', $id)->update(['active' => 1]);
    //     $this->model->insert($roles_user_insert);

    // }

    public function roleUserActive($id, $roles_user_active){
        $this->model->whereIn('role_id', $roles_user_active)->where('admin_id', $id)->update(['active' => AdminEnum::STATUS_ACTIVE]);
    }

    public function roleUserInactive($id, $roles_user_inactive){
        $this->model->whereIn('role_id', $roles_user_inactive)->where('admin_id', $id)->update(['active' => AdminEnum::STATUS_INACTIVE]);
    }

    public function roleUserInsert($id, $roles_user_insert){
        $this->model->insert($roles_user_insert);
    }
    // public function getAdminRole()
    // {
    //     $usersRole = $this->model->with('permission')->where('active', '1')->get();
    //     $arr = array();
    //     foreach ($usersRole as $user) {
    //         if (isset($arr[$user->admin_id])) {
    //             $arr[$user->admin_id] .= '<br>- ' . $user->permission->title;
    //         } else {
    //             $arr[$user->admin_id] = '';
    //             $arr[$user->admin_id] .= '- ' . $user->permission->title;
    //         }
    //     }
    //     return $arr;
    // }
}

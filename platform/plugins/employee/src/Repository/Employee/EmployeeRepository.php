<?php

namespace Workable\Employee\Repository\Employee;

use Workable\Employee\Models\Admin;
use Workable\Support\Repositories\Eloquent\BaseRepository;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    protected $model;
    protected $id;


    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function list($filter=false, $sort = false, $paginate = 10)
    {
        $query = $this->model->with('admin', 'company', 'department', 'roles');
        $query = $this->scopeFilter($query, $filter);
        $query = $this->scopeSort($query, $sort);
        $items = $query->paginate($paginate);
        return $items;
    }

    public function findUser($id){
        return $this->model->with('roles')->find($id);
    }

    // public function getAdminRoleEdit($id)
    // {
    //     $admin_role = AdminRoleUser::where("admin_id", $id)->where('active', 1)->get();
    //     $admin_role_arr = array();
    //     if ($admin_role->isEmpty()) {
    //         return [];
    //     }
    //     if ($admin_role[0]->role_id == 1) {
    //         array_push($admin_role_arr, $admin_role[0]->permission->name);
    //     } else {
    //         foreach ($admin_role as $key => $value) {
    //             array_push($admin_role_arr, $value->permission->name);
    //         }
    //     }
    //     return $admin_role_arr;
    // }

    // public function updateAdminRole($id, $role_delete, $role_exist, $role_insert)
    // {
    //     // dd($role_delete, $role_exist, $role_insert);
    //     if (!empty($role_insert)) {
    //         if ($role_insert[0]['role_id'] == 1) {
    //             Permission::where('id', '<>', '0')->increment('number_user', 1);
    //             Role::where('id', 1)->increment('number_user', 1);
    //         } else {
    //             foreach ($role_insert as $item) {
    //                 $this->id = $item['role_id'];
    //                 Permission::whereHas('roles', function ($query) {
    //                     $query->where('role_id', $this->id);
    //                 })->increment('number_user', 1);
    //                 Role::where('id', $item['role_id'])->increment('number_user', 1);
    //             }
    //         }
    //     }
    //     if (!empty($role_exist)) {
    //         $check = AdminRoleUser::where([['admin_id', $id], ['role_id', 1], ['active', 0]])->count();
    //         if ($role_exist[0] == 1 && $check) {
    //             // dd($check);
    //             Permission::where('id', '<>', '0')->increment('number_user', 1);
    //             Role::where('id', 1)->increment('number_user', 1);
    //         } else {
    //             // dd($role_exist);
    //             foreach ($role_exist as $item) {
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
    //     if (!empty($role_delete)) {
    //         if ($role_delete[0] == 1) {
    //             $check = AdminRoleUser::where([['admin_id', $id], ['role_id', 1], ['active', 1]])->count();
    //             if($check){
    //                 Permission::where('id', '<>', '0')->decrement('number_user', 1);
    //                 Role::where('id', 1)->decrement('number_user', 1);
    //             }
    //         }
    //         foreach ($role_delete as $item) {
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
    //     AdminRoleUser::whereIn('role_id', $role_delete)->where('admin_id', $id)->update(['active' => 0]);
    //     AdminRoleUser::whereIn('role_id', $role_exist)->where('admin_id', $id)->update(['active' => 1]);
    //     AdminRoleUser::insert($role_insert);

    // }
}

<?php

namespace Workable\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Company\Models\Menu;
use Workable\Employee\Models\Admin;
use Workable\Employee\Models\AdminRoleUser;

class Permission extends Model
{
    protected $table = 'admin_permissions';
    protected $guarded = [];
    public $timestamps = true;

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role_permission', 'permission_id', 'role_id')->where('active', 1);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_permission_user', 'permission_id', 'admin_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function roleUser(){
        return $this->belongsToMany(AdminRoleUser::class,'admin_role_permission','permission_id', 'role_id','id','role_id');
    }

}

<?php

namespace Workable\Employee\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Acl\Models\AdminRolePermission;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\Role;
use Workable\Employee\Models\Admin;

class AdminRoleUser extends Model
{
    protected $fillable = [];
    protected $table = 'admin_role_user';

    public function permission(){
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function rolePermission(){
        return $this->belongsTo(AdminRolePermission::class, 'role_id', 'role_id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function roleUser(){
        return $this->belongsToMany(Permission::class,'admin_role_permission','role_id', 'permission_id','role_id','id');
    }
}

<?php

namespace Workable\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Employee\Models\AdminRoleUser;

class AdminRolePermission extends Model
{
    protected $fillable = [];
    protected $table = 'admin_role_permission';

    public function adminRoleUser(){
        return $this->belongsTo(AdminRoleUser::class, 'role_id', 'role_id');
    }
    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function permission(){
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}

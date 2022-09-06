<?php

namespace Workable\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Workable\Acl\Traits\RoleTrait;
use Workable\Employee\Models\Admin;
use Workable\Employee\Models\AdminRoleUser;
use Workable\Organization\Models\Company;

class Role extends Model
{
    use RoleTrait;

    protected $table = 'admin_roles';
    protected $guarded = [];
    public $timestamps = true;


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_role_user', 'role_id', 'admin_id')->where('admin_role_user.active', 1);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admin_role_permission', 'role_id', 'permission_id')->where('active', 1);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function rolePermission(){
        return $this->belongsToMany(Permission::class, 'admin_role_permission', 'role_id', 'permission_id')->where('active', 1);
    }

    // public function roleAdmin()
    // {
    //     return $this->belongsToMany(Admin::class, 'admin_role_user', 'role_id', 'admin_id')->where('admin_role_user.active', 1);
    // }
   
    public function roleUser(){
        return $this->belongsTo(AdminRoleUser::class,'id', 'role_id');
    }
}

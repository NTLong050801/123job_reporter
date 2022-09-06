<?php

namespace Workable\Employee\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Workable\Acl\Models\AdminRolePermission;
use Workable\Acl\Models\Permission;
use Workable\Acl\Models\Role;
use Workable\Employee\Enum\AdminEnum;
use Workable\Employee\Traits\AdminTrait;
use Workable\Employee\Traits\CacheTrait;
use Workable\Organization\Models\Company;
use Workable\Organization\Models\Department;


class Admin extends Model implements AuthenticatableContract
{
    use AdminTrait, CacheTrait;
    use Authenticatable;

    public $table = 'admins';
    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role_user', 'admin_id', 'role_id')->where('active', AdminEnum::STATUS_ACTIVE);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admin_permission_user', 'admin_id', 'permission_id')->where('active', AdminEnum::STATUS_ACTIVE);
    }

    public static function user()
    {
        return Auth::guard('admins')->user();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (in_array($model->id, ['1'])) {
                return false;
            }
            $model->roles()->detach();
            $model->permissions()->detach();
        });
    }

    public function adminPermission()
    {
        return $this->belongsToMany(AdminRolePermission::class, 'admin_role_user', 'admin_id', 'role_id', 'id', 'role_id');
    }

    public function role()
    {
        return  $this->hasMany(AdminRoleUser::class, 'admin_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}

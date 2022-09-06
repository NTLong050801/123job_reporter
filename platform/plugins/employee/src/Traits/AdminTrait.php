<?php

namespace Workable\Employee\Traits;

use Illuminate\Support\Facades\Cache;
use Workable\Acl\Enum\RoleEnum;

trait AdminTrait
{
    /**
     * Get all roles of current user
     * @return mixed
     */
    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cache_key = $this->makeKeyCache('roles_for_user', $this->$userPrimaryKey);
        return Cache::remember($cache_key, 2, function () {
            return $this->roles()->get();
        });
    }

    /**
     * Check role of current user
     *
     * @param [type] $name
     * @param boolean $requireAll
     * @return boolean
     */
    public function hasRole($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$requireAll) {
                    return true;
                } elseif (!$hasRole && $requireAll) {
                    return false;
                }
            }
            return $requireAll;
        } else {
            foreach ($this->cachedRoles() as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get all permissions of current user
     * Include permission by role, permission by user
     * @return
     */
    public function cachedPermissions()
    {
        $userPrimaryKey = $this->primaryKey;
        $cache_key = $this->makeKeyCache('permission_for_user', $this->$userPrimaryKey);

        return Cache::remember($cache_key, 2, function () {
            $permission_all = $this->permissions()->get();
            foreach ($this->cachedRoles() as $role) {
                $permission_all = $permission_all->merge($role->cachedPermissions());
            }
            return $permission_all;
        });
    }

    /**
     * Check permission of user
     *
     * @param [type] $permission
     * @param boolean $requireAll
     * @return boolean
     */
    public function can($permission, $requireAll = false)
    {
        if (is_array($permission)) {
            foreach ($permission as $permName) {
                $hasPerm = $this->can($permName, $requireAll);
                // dump('----'. $hasPerm);
                // dump('reuie = '.$requireAll);
                if ($hasPerm && !$requireAll) {
                    return true;
                } elseif (!$hasPerm && $requireAll) {
                    // dd(123);
                    return false;
                }
            }
            return $requireAll;
        } else {
            // dump($permission);
            foreach ($this->cachedPermissions() as $perm) {
                if (!strcmp($perm->name, $permission)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function cannot(string $permission): bool
    {
        return !$this->can($permission);
    }

    public function isAdministrator(): bool
    {
        return $this->hasRole(RoleEnum::SUPER_ADMIN);
    }
}

<?php

namespace Workable\Acl\Traits;

use Illuminate\Support\Facades\Cache;

trait RoleTrait
{
    /**
     * Lấy ra tất cả permission ứng với role đó
     *
     * @return void
     */
    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'permission_for_role_'.$this->$rolePrimaryKey;
        return Cache::remember($cacheKey, 2, function () {
            return $this->permissions()->get();
        });
    }

    /**
     * Check Permission có trong role đó không
     */

    public function hasPermissions($name, $requireAll = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermissions($permissionName);

                if ($hasPermission && !$requireAll) {
                    return true;
                } elseif (!$hasPermission && $requireAll) {
                    return false;
                }
            }
            return $requireAll;
        } else {
            foreach ($this->cachedPermissions() as $perm) {
                if (str_contains($perm->name, $name)) {
                    return true;
                }
            }
        }

        return false;
    }
}

?>
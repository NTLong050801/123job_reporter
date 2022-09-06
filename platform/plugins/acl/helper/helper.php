<?php

if (!function_exists('can')) {
    function can($permission, $requireAll = false)
    {
        $current_user = Auth::guard('admins')->user();
        if ($current_user->isAdministrator()) return true;
        return $current_user->can($permission, $requireAll);
    }
}

if (!function_exists('hasRole')) {
    function hasRole($permission, $requireAll = false)
    {
        $current_user = Auth::guard('admins')->user();
        return $current_user->hasRole($permission, $requireAll);
    }
}


if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        $current_user = Auth::guard('admins')->user();
        return $current_user->isAdministrator();
    }
}

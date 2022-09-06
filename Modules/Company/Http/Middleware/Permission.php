<?php

namespace Modules\Company\Http\Middleware;

use Closure;
use Workable\Employee\Models\Admin;
use Modules\Company\Models\Permission as Checker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Permission
{
    protected $middlewarePrefix = 'admin.permission:';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Admin::user() ||
            !empty($args) ||
            $this->shouldPassThrough($request) ||
            Admin::user()->isAdministrator() ||)
        {
            return $next($request);
        }

        // Allow access route
        if ($this->routeDefaultPass($request)) {
            return $next($request);
        }

        //Check middleware in route
        if ($this->checkRoutePermission($request)) {
            return $next($request);
        }

        if (!Admin::user()->allPermissions()->first(function ($permission) use ($request)
        {
            //Method shouldPassThrough in \App\Admin\Models\AdminPermission ->shouldPassThrough
            return $permission->shouldPassThrough($request);
        })) {
            return Checker::error();
        }

        return $next($request);
    }

    /**
     * If the route of current request contains a middleware prefixed with 'admin.permission:',
     * then it has a manually set permission middleware, we need to handle it first.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkRoutePermission(Request $request)
    {
        if (!$middleware = collect($request->route()->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }
        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(Checker::class, $method)) {
            throw new \InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func_array([Checker::class, $method], [$args]);

        return true;
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough($request)
    {
        $routeName = $request->path();
        $excepts = [
            config('app.admin_prefix') . '/auth/login',
            config('app.admin_prefix') . '/auth/logout',
        ];
        return in_array($routeName, $excepts);
    }

    /*
    Check route defualt allow access
     */
    public function routeDefaultPass(Request $request)
    {
        $routeName = $request->route()->getName();
        $allowRoute = ['admin.deny'];
        return in_array($routeName, $allowRoute);
    }
}

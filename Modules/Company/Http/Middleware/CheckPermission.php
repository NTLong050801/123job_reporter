<?php

namespace Modules\Company\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Workable\Employee\Models\Admin;

class CheckPermission
{
    private $admin;

    public function __construct()
    {
        $this->admin = Admin::user();
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->admin->isAdministrator()) {
            return $next($request);
        }

        // dd(1);
        // Allow access route
        if ($this->routeDefaultPass($request)) {
            return $next($request);
        }
        // dd(123);
        // Check permission by route name
        if(!$this->checkPermission($request))
        {
            $uriCurrent    = request()->fullUrl();
            $uri = explode('/',parse_url($uriCurrent)['path'])[1];
            return $this->error();
            // return redirect()->route('default', $uri);
        }

        return $next($request);
    }

    public function checkPermission(Request $request)
    {
        $routeName = $request->route()->getName();
        // dd($routeName);
        return $this->admin->can($routeName);
    }

    /*
    Check route default allow access
     */
    public function routeDefaultPass(Request $request)
    {
        $routeName = $request->route()->getName();
        // dd($routeName);
        $allowRoute = config('company::permission.allow_route');
        return in_array($routeName, $allowRoute);
    }

    private function error()
    {
        $uriCurrent    = request()->fullUrl();
        $methodCurrent = request()->method();
        if (strtoupper($methodCurrent) === 'GET')
        {
            // dd(1);
            return redirect()->route('error.403', $uriCurrent);
        }
        else
        {
            return response()->json([
                'error'   => '1',
                'status'  => 403,
                'message' => 'Hành động bị từ chối!',
                'detail'  => [
                    'method' => $methodCurrent,
                    'url'    => $uriCurrent
                ]
            ]);
        }
    }
}

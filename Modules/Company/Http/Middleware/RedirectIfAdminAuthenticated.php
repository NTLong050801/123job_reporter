<?php

namespace Modules\Company\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (!Auth::guard('admins')->check() || !get_data_user('admins', 'active')) {
            return redirect('/authenticate/login');
        }
        return $next($request);
    }
}

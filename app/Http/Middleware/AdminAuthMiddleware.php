<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('isAdmin')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

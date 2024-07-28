<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class CollectStatistics
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        Visitor::create([
            'visit_time' => now(),
            'web_page' => $request->path(),
            'ip_address' => $request->ip(),
            'host_name' => gethostbyaddr($request->ip()),
            'browser_name' => $request->header('User-Agent'),
        ]);

        return $response;
    }
}
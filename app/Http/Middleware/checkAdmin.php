<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkAdmin
{

    public function handle(Request $request, Closure $next)
    {
        $admin = auth()->user()->admin ?? 0;
        if ($admin){
            return $next($request);
        }
        return back()->withErrors(['error' => __("Can't Access This Page") ]);
    }
}

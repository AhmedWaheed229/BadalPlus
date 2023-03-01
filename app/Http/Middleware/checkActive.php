<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkActive
{

    public function handle(Request $request, Closure $next)
    {
        $active = auth()->user()->active ?? 0;
        if ($active){
            return $next($request);
        }
        auth()->logout();
        return redirect()->route('login')->withErrors(['error' => __('user not active') .' '. __('please wait for activation') ]);
    }
}

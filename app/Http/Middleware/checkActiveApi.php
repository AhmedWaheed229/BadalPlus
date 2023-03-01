<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class checkActiveApi
{

    public function handle(Request $request, Closure $next)
    {
        $active = auth('api')->user()->active ?? 0;
        if ($active){
            return $next($request);
        }
        $user = User::find(auth('api')->id());
        $user->api_token = null;
        $user->save();
        return response()->json([
            "status" => false,
            "msg" => __("user not active"),
        ]);
    }
}

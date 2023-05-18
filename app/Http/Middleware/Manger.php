<?php

namespace App\Http\Middleware;
use Closure, Auth;
class Manger
{
    use \App\Traits\ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(Auth::user()->type !=1)
            return $this->apiResponseMessage(0,'only Manger can use this request',400);
        return $next($request);
    }
}


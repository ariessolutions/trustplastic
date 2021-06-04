<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route=Route::getFacadeRoot()->current()->uri();
        if((new Permissions)->isValid($route)){
            return $next($request);
        }else{
            return abort(403,'Not permitted to access.');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!request()->user()  || request()->user()->role != "admin" || !request()->user()->is_allowed){
            return redirect("/");
            return abort(401, "You are not allowed here");
        }
        return $next($request);
    }
}

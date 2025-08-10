<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThrottleSubmissions
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $maxAttempts = 3, $decayMinutes = 1440): Response
    {
        $key = 'submissions.'.$request->ip();

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return abort(429, 'Too many submissions. Please try again later.');
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }

}

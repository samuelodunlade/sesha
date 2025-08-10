<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThrottleVotes
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next, $maxAttempts = 30, $decayMinutes = 1440): Response
    {
        $key = 'votes.'.$request->ip();

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return response()->json(['error' => 'You have reached your daily voting limit.'], 429);
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        return $next($request);
    }
}

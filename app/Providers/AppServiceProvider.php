<?php

namespace App\Providers;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Use Bootstrap 5 for pagination
        Paginator::useBootstrapFive();


        //rate limiter
        RateLimiter::for('post_submit', function (Request $request) {
            //if request is from admin, allow unlimited
            if ($request->user()?->isAdmin()) {
                return Limit::none();
            }else{
                return Limit::perHour(2)->by($request->user()?->id ?: $request->ip());
            }
            
        });

        RateLimiter::for('homepage', function (Request $request) {
            return Limit::perHour(200)->by($request->user()?->id ?: $request->ip());
        });

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        

    }
}

<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Apis v1
            Route::middleware(['api', 'check_lang_api'])
                ->prefix('api/v1')
                ->namespace("App\Http\Controllers\Api\V1")
                ->group(base_path('routes/api_v1.php'));

            Route::middleware(['web' ,'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
                ->prefix(LaravelLocalization::setLocale())
                ->namespace("App\Http\Controllers")
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
                ->namespace("App\Http\Controllers\Dashboard")
                ->prefix(LaravelLocalization::setLocale().'/dashboard')
                ->group(base_path('routes/dashboard.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

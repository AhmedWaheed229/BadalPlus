<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__ . '/../Helpers/Navigation.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            $settings = Setting::firstOrCreate();
            $main_categories = Category::MainActive()->get();
            $currencies = Currency::Active()->get();
            $view->with([
                'settings'=> $settings,
                'main_categories'=> $main_categories,
                'currencies'=> $currencies,
            ]);
        });
    }
}

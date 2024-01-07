<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Carbon::setLocale('id');
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role == 'admin';
        });
        Blade::if('user', function () {
            return auth()->check() && auth()->user()->role == 'user';
        });
        View::composer('*', function ($view) {
            $cartCount = DB::table('carts')->where('user_id', auth()->id())->count();
            $view->with('cartCount', $cartCount);
        });
    }
}

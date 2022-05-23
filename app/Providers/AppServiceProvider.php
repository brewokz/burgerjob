<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer(
        //     'product',
        //     'App\Http\ProductController'
        // );
        view()->composer('*', function ($view) {
            $cart = session('cart');
            if ($cart == null) {
                $countCart = 0;
                $view->with('countCart', $countCart);
            } else {
                $countCart = count($cart);
                //dd($countCart);
                $view->with('countCart', $countCart);
            }
        });

        // Session::put('cart', []);
        // //dd(session('cart'));
        // $cart = session('cart');
        // if ($cart == null) {
        //     $countCart = 0;
        //     View::share('countCart', $countCart);
        // } else {
        //     //$countCart = count($cart);
        //     $countCart = session()->increment('count');
        //     View::share('countCart', $countCart);
        // }
        // View::share('countCart', $countCart);
    }
}

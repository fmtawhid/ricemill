<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 'categories' হিসেবে ক্যাটাগরি মডেল রেজিস্টার করা
        $this->app->singleton('categories', function () {
            return Category::with('subCategories')->get(); // Load categories with subCategories
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ক্যাটাগরি ডেটা ভিউতে গ্লোবালি পাস করা
        view()->composer('*', function ($view) {
            $view->with('categories', app('categories')); // Pass categories globally to views
        });
    }
}

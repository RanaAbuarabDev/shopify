<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        Relation::enforceMorphMap([
            'admin'=> Admin::class,
            'customer'=> Customer::class,
            'marchant'=> Merchant::class,
            'user'=>User::class,
            'category' => Category::class,
            'product' => Product::class,
        ]);
    }
}

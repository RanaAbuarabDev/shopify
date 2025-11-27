<?php

namespace App\Providers;

<<<<<<< HEAD
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
=======
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
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
<<<<<<< HEAD
        Relation::enforceMorphMap([
            'admin'=> Admin::class,
            'customer'=> Customer::class,
            'merchant'=> Merchant::class,
            'user'=>User::class,
            'category'=> Category::class,
            'product'=> Product::class,
        ]);
=======
        //
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
    }
}

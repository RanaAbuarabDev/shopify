<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Merchant;
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
    'marchant'=> Merchant::class
]);
    }
}

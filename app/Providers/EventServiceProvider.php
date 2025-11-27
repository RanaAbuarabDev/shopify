<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Product;
use App\Observers\CartItemObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        CartItem::observe(CartItemObserver::class);
    }
}

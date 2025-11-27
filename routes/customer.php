<?php
use App\Http\Controllers\api\Customer\AuthController;
use App\Http\Controllers\api\Customer\CartController;
use App\Http\Controllers\api\Customer\CartItemController;
use App\Http\Controllers\api\Customer\HomePageController;
use App\Http\Controllers\api\Customer\OrderController;
use App\Http\Controllers\api\Customer\ProductController;
use App\Http\Controllers\api\Customer\ShippingAddressController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    });
Route::middleware(['auth:sanctum', 'user-type:customer'])->group(function () {

    Route::get('products', [ProductController::class, 'get']);

    // broswe products in home page

    Route::get('home_page_data', HomePageController::class);
    Route::get('cart', [CartController::class, 'myCart']);
    Route::apiResource('cart_item', CartItemController::class);
    

    Route::post('checkout', [OrderController::class, 'checkout']);
    Route::apiResource('shipping_address', ShippingAddressController::class);


    // search products




    // add to wishlist

    // add card

    // checkout (transfor the card into order)

    // pay the order


});

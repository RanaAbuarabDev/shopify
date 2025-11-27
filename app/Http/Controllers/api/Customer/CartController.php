<?php

namespace App\Http\Controllers\api\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CartResource;
use App\Models\Cart;

class CartController extends Controller
{
    public function myCart()
    {        
        $myCart = Cart::with(['cartItems.product'])
            ->firstOrCreate(
            ['customer_id' => auth()->user()->user_id, 'status' => 'open']
        );
        return response()->json(ResponseFormatter::success('Cart fetched successfully', [
            'cart' => CartResource::make($myCart),
        ]));
    }
}
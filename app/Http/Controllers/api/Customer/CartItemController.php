<?php

namespace App\Http\Controllers\api\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\StoreItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartItemController extends Controller
{
    public function store(StoreItem $request)
    {
        try {

            $data = $request->validated();

            DB::beginTransaction();

            $cart = Cart::firstOrCreate(
                ['customer_id' => auth()->user()->user_id, 'status' => 'open']

            );
            $product = Product::find($data['product_id']);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'price' => $product['price'],
                'total_price' => $product['price'] * $data['quantity'],


            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
        return ResponseFormatter::success("item added to cart successfully");
    }

    public function destroy(CartItem $cartItem)
    {
        try {
            $this->authorize('delete', $cartItem);
            
            $cartItem->delete();

        }
        catch (\Illuminate\Auth\Access\AuthorizationException $exception) {
            return ResponseFormatter::error("you are not authorized to delete this item", 403);
        }
         catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }

    public function update(Request $request, CartItem $CartItem)
    {

        try {
            $CartItem->update(['quantity'=> $request->quantity]);
            return ResponseFormatter::success("item updated successfully",$CartItem);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }


    }
}

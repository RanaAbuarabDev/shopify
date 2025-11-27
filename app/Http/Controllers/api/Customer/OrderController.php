<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Order\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // pending, processing, completed 
    public function checkout(CheckoutRequest $request)
    {
        $shippingAddressId = $request->shipping_address_id;

        try {
            DB::beginTransaction();
            $customerCard = Cart::with(['cartItems.product'])
                ->where(['customer_id' => auth()->user()->user_id, 'status' => 'open'])
                ->first();

            if (!$customerCard) return 'empty card';

            $cardItems = $customerCard->cartItems;

            if (count($cardItems) == 0) return 'empty card';

            $order = Order::query()->create([
                'customer_id' => $request->user()->user_id,
                
                'shipping_address_id' => $shippingAddressId,
                'amount' => $cardItems->sum('total_price')
            ]);

            $productToMerchantMapping = Product::query()
            ->whereIn('id', $cardItems->pluck('product_id')->toArray())
            ->pluck('merchant_id', 'id');

            $orderItemsData = collect($cardItems)->select(['product_id', 'quantity', 'price'])->map(function($cardItem)use($productToMerchantMapping){
                $cardItem['merchant_id'] = $productToMerchantMapping[$cardItem['product_id']];
                return $cardItem;
            })->toArray();

            /** @var Order $order */
            $order->orderItems()->createMany($orderItemsData);


            // create stripe payment intent

            $stripe = new \Stripe\StripeClient(config('stripe.secret_key'));



            $lineItems = [];
            foreach ($order->orderItems as $item) {
                $productName = $item->product->name;
                $quantity = $item->quantity;
                $unitPrice = $item->price;

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $productName,
                        ],
                        'unit_amount' => $unitPrice * 100,
                    ],
                    'quantity' => $quantity,
                ];
            }
            
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('stripe.success'),
                'cancel_url' => route('stripe.cancel'),
            ]);

            Payment::create([
                'order_id' => $order->id,
                'session_id' => $checkout_session->id,
                'status' => 'pending',
                'currency' => 'usd',
                'amount' => $order->amount,
            ]);

            $customerCard->delete();
            
            DB::commit();
            
            return response()->json([
                'checkout_session' => $checkout_session->url
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\api\Merchant;

use App\Enums\ImagePositionEnum;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Merchant\OrderItem\UpdateOrderItemRequest;
use App\Http\Requests\Merchant\Product\StoreProductRequest;
use App\Http\Resources\Merchant\ProductResource;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderItemController
{

    public function index(){
        $orderItems = OrderItem::query()
        ->where('merchant_id', '=', auth()->user()->user_id)
        ->get();

        return response()->json(ResponseFormatter::success($orderItems));
    }

    public function show(OrderItem $orderItem){

        return response()->json(ResponseFormatter::success($orderItem));
    }
    
    public function update(OrderItem $orderItem, UpdateOrderItemRequest $request)
    {

        $orderItem->update([
            'status' => $request->input('status')
        ]);

        return response()->json(ResponseFormatter::success('', $orderItem));
    }
}
<?php

namespace App\Http\Controllers\api\Merchant;

use App\Enums\ImagePositionEnum;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Merchant\Product\StoreProductRequest;
use App\Http\Resources\Merchant\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController{


    public function index(){
        $products = Product::query()
        ->with(['category','mainImage'])
        ->where('merchant_id', '=', auth()->user()->user_id)
        ->get();

        return response()->json(ResponseFormatter::success(ProductResource::collection($products)));
    }

    public function show(){
        
    }
    
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'category_id' => $data['category_id'],
                'description' => $data['description'] ?? null,
                'merchant_id' => auth()->user()->user_id
            ]);
            foreach ($data['images'] ?? [] as $image) {
                $product->addimage($image['path'], ImagePositionEnum::from($image['position']), 'public', 0);
            }
            DB::commit();
            return ResponseFormatter::success("Product created successfully", ProductResource::make($product));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }
    
    public function update(){

    }

    public function destroy(){

    }
}
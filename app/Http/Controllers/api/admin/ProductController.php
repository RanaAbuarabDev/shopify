<?php

namespace App\Http\Controllers\api\admin;

use App\Enums\ImagePositionEnum;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return ResponseFormatter::success(
                ProductResource::collection($products)
            );
        } catch (\Exception $exception) {
            log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }

    public function show(Product $product)
    {
        return ResponseFormatter::success(ProductResource::make($product));
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
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();
            $product->update($data);
            return ResponseFormatter::success(ProductResource::make($product));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return ResponseFormatter::success('Product deleted successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }
}

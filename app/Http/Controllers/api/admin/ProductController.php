<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;


class ProductController extends Controller
{
    public function index(){
        try{
        $products = Product::all();
        return ResponseFormatter::success($products);}
        catch (\Exception $exception){
            log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }
    }

    public function show(Product $product){
        return ResponseFormatter::success($product);
    }
    public function store(StoreProductRequest $request){
        try{
        $data = $request->validated();
        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
        ]);
        return ResponseFormatter::success("Product created successfully",$product);}
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }

    }
    public function update(UpdateProductRequest $request, Product $product){
        try{
            $data = $request->validated();
            $product->update($data);
            return ResponseFormatter::success($product);
        }
        catch (\Exception $exception){
            Log::error($exception->getMessage());
            return ResponseFormatter::error("an error occurred");
        }

    }
    public function delete(Product $product){
        try{
        $product->delete();
        return ResponseFormatter::success('Product deleted successfully');
    }catch(\Exception $exception){
        Log::error($exception->getMessage());
        return ResponseFormatter::error("an error occurred");}
    }
}

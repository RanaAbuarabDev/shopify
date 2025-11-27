<?php

namespace App\Http\Controllers\api\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CategoryResource;
use App\Http\Resources\Customer\ProductResource;
use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{

    
    public function __invoke()
    {
        return response()->json(ResponseFormatter::success([
            'top_main_categories' =>CategoryResource::collection ($this->getTopMainCategories()),
            'banner_products' => ProductResource::collection($this->getBannerProducts()),
            'popular_products' =>ProductResource::collection ($this->getPopularProducts()),
            'offers_products' => ProductResource::collection($this->getOffersProducts())
        ]));
    }

    public function getTopMainCategories()
    {
         return Category::whereNull('parent_category_id')->limit(10)->get();
    }

    public function getBannerProducts()
    {
        return Product::with('mainImage')->where('is_banner',1)->limit(20)->get();
    }

    public function getPopularProducts()
    {
        return Product::with('mainImage')->where('is_popular',1)->limit(20)->get();
    }

    public function getOffersProducts()
    {
        return Product::with('mainImage')->where('is_offer',1)->limit(20)->get();
    }

}

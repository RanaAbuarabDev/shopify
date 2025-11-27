<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{

    public function get()
    {
        return Product::with('category')
        ->when(request()->has('category_id'), function($query){
            $query->where('category_id', request()->category_id);
        })
        ->when(request()->has('color'), function($query){
            $query->whereHas('caregory', function($query){
                $query->where('color', request()->color);
            });
            $query->whereRelation('category', 'color', '=', request()->color);
        })
        ->when(request()->has('search'), function($query){
            $query->where('name', 'like', '%' . request()->search . '%');
        })
        ->when(request()->has('is_banner'), function($query){
            $query->where('is_banner', request()->is_banner);
        })
        ->when(request()->has('is_popular'), function($query){
            $query->where('is_popular', request()->is_popular);
        })
        ->when(request()->has('is_offer'), function($query){
            $query->where('is_offer', request()->is_offer);
        })
        ->when(request()->has('sort'), function($query){
            $query->orderBy('price', request()->sort);
        })
        ->when(request()->has('limit'), function($query){
            $query->limit(request()->limit);
        })
        ->when(request()->has('page'), function($query){
            $query->paginate(request()->page);
        })
        ->get();
    }

}

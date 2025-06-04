<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(){
        try {


        $categories = Category::all();
        return response()->json($categories,200);
    }catch (\Exception $exception){
        return response()->json(['error'=>$exception->getMessage()]);}
    }
    public function show($id){
        try{
        $category=Category::where('id',$id)->first();
        if(!$category){
            return response()->json(['message'=>'category not found'],404);
        }
        return response()->json($category);

    }catch (\Exception $exception){
        return response()->json(['error'=>$exception->getMessage()]);}
    }
    public function store(Request $request){
$validator=Validator::make($request->all(),[
    'name'=>'required|string|unique:categories,name',
]);
if($validator->fails()){
    return response()->json($validator->errors());
}
        try {


Category::create(['name'=>$request->name]);
return response()->json('Category created');

    }catch (\Exception $exception){
return response()->json(['error'=>$exception->getMessage()]);}
    }
    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'name'=>'string|unique:categories,name,'.$id,
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        try{
        $category=Category::where('id',$id)->first();
        $category->name=$request->name??$category->name;

        $category->save();
        return response()->json('Category updated');

    }catch (\Exception $exception){
        return response()->json(['error'=>$exception->getMessage()]);}
    }
    public function destroy($id){
        try{
        $category=Category::where('id',$id)->first();
        if(!$category){
            return response()->json(['message'=>'category not found'],404);
        }
        $category->delete();
        return response()->json('category deleted',200);
    }
    catch (\Exception $exception){
        return response()->json(['error'=>$exception->getMessage()]);}
    }
}

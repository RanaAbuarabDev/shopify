<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return ResponseFormatter::success('Categories fetched successfully', $categories);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to get categories');
        }
    }
    public function show(Category $category)
    {
        try {
            return ResponseFormatter::success('Category fetched successfully', $category);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to get category');
        }
    }
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = Category::create([
                'name' => $request->name,
                'description'=> $request->description,
                'slug' => Str::slug($request->name)
            ]);
            return ResponseFormatter::success('Category created successfully', $category);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to create category');
        }
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        try {
            $data['slug'] = Str::slug($request->name);
            $category->update($data);
            return ResponseFormatter::success('Category updated successfully', $category);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to update category');
        }
    }
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return ResponseFormatter::success('Category deleted successfully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to delete category');
        }
    }
}

<?php

namespace App\Http\Controllers\api\admin;

use App\Enums\ImagePositionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
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
            $categories = Category::with(['mainImage'])->withCount('products')->get();
            
            return ResponseFormatter::success('Categories fetched successfully', CategoryResource::collection($categories));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return ResponseFormatter::error('Failed to get categories');
        }
    }
    public function index_tree()
    {
        try {
            $categories = Category::with(['mainImage', 'subCategories'])->whereNUll('parent_category_id')->get();

            return ResponseFormatter::success('Categories fetched successfully', CategoryResource::collection($categories));
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
            DB::beginTransaction();
            /** @var Category */
            $category = Category::create([
                'name' => $request->name,
                'description'=> $request->description,
                'slug' => Str::slug($request->name)
            ]);

            foreach($request->images as $image)
            {
                $category->addImage($image['path'], ImagePositionEnum::from($image['position']), 'public', $image['is_main']);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage(), $exception->getTrace());
            return ResponseFormatter::error('Failed to create category');
        }

        return ResponseFormatter::success('Category created successfully', CategoryResource::make($category));

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

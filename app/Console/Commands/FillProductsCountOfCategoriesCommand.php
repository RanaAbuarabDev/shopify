<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class FillProductsCountOfCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-products-count-of-categories-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Category::query()->whereNull('parent_category_id')->each(function($category){
            $this->getProductsCount($category);
        });
    }


    public function getProductsCount(Category $category)
    {
        $directedRelatedProductsCount = $category->products()->count();

        $subCategoriesProductsCount = 0;

        $category->subCategories()->each(function($category) use(&$subCategoriesProductsCount){
            $subCategoriesProductsCount += $this->getProductsCount($category);
        });

        $category->products_count = $directedRelatedProductsCount + $subCategoriesProductsCount;
        $category->save();

        return $category->products_count;
    }
}

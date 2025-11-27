<?php

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RefreshCategoryPathJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $category, public $count)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $category=$this->category;
        while($category){
            $category->increment('products_count', $this->count);
            $category=$category->parent_category()->first();
        }

    }
}

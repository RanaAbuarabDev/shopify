<?php

namespace App\Models;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasImages, HasFactory;

    protected static function booted()
    {
        static::creating(function($category){
            $category->slug = Str::slug($category->name .'-'. time());
        });
       
    }
    protected $fillable = ['name','merchant_id','description','products_count','parent_category_id'];
    public function merchant(){
        return $this->belongsTo(Merchant::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
    
    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_category_id')->with('subCategories');
    }
    public function parent_category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}


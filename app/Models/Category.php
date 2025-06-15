<?php

namespace App\Models;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{    
    use HasImages;


    protected static function booted()
    {
        static::creating(function($category){
            $category->slug = Str::slug($category->name);
        });
        static::updating(function($category){
            $category->slug = Str::slug($category->name);
        });
    }
    protected $fillable = ['name','merchant_id','description'];
    public function merchant(){
        return $this->belongsTo(Merchant::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}


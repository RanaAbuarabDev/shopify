<?php

namespace App\Models;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasImages;


    protected $fillable = ['name', 'price','description', 'category_id'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}

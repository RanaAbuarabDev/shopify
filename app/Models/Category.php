<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','merchant_id','description'];
    public function merchant(){
        return $this->belongsTo(Merchant::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}


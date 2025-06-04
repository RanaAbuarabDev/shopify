<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','marchant_id','description'];
    public function marchant(){
        return $this->belongsTo(Marchant::class);
    }
}


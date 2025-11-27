<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable=['path', 'disk', 'is_main', 'position'];

    public function imageable(){
        return $this->morphTo();
    }

    public function url(): Attribute
    {
        return Attribute::make(get: fn() => $this->disk == 'public' ? Storage::disk('public')->url($this->path) : null);
    }
}

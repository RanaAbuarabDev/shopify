<?php

namespace App\Models;

use App\Enums\ImagePositionEnum;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'position', 'disk', 'is_main'];

    protected $casts = [
        'position' => ImagePositionEnum::class
    ];
}

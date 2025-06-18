<?php

namespace App\Traits;

use App\Enums\ImagePositionEnum;
use App\Models\Image;

trait HasImages
{
   
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function mainImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_main', '=', true);
    }
   
    public function addImage(string $path, ImagePositionEnum $position, $disk, $isMain)
    {
        return $this->images()->create([
            'path' => $path,
            'position' => $position,
            'disk' => $disk,
            'is_main' => $isMain
        ]);
    }

    public function updateImage(int $id, string $path, ImagePositionEnum $position)
    {
        $image = $this->images()->findOrFail($id);
        $image->update([
            'path' => $path,
            'position' => $position
        ]);
        return $image;
    }


    public function deleteImage(int $id)
    {
        $image = $this->images()->findOrFail($id);
        $image->delete();
        return $image;
    }

    
    public function getImage(int $id)
    {
        return $this->images()->findOrFail($id);
    }

    
    public function getImages()
    {
        return $this->images()->get();
    }
}

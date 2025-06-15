<?php

namespace App\Traits;

use App\Models\Image;

trait HasImages
{
   
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

   
    public function addImage(string $path)
    {
        return $this->images()->create([
            'path' => $path,
        ]);
    }

    public function updateImage(int $id, string $path)
    {
        $image = $this->images()->findOrFail($id);
        $image->update(['path' => $path]);
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

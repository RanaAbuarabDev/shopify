<?php
namespace App\Traits;
use App\Enums\ImagePositionEnum;
use App\Models\Image;

trait HasImages{
    public function images(){
       return $this->morphMany(Image::class, 'imageable');
    }
    public function mainImage(){
        return $this->morphOne(Image::class, 'imageable')->where('is_main', '=', 1);
    }
    public function addImage(string $path,ImagePositionEnum $position,$disk, $is_main){
     return   $this->images()->create([
            'path' => $path,
         'position' => $position,
         'disk' => $disk,
         'is_main' => $is_main

        ]);
    }
    public function updateImage(string $path,$id){
        return $this->images()->where('id',$id)->update([
            'path' => $path
        ]);
    }
    public function deleteImage($id){
        return $this->images()->where('id',$id)->delete();
    }
    public function showImage($id){
        return $this->images()->where('id',$id)->first();
    }
    public function showImages(){
        return $this->images()->get();
    }
}

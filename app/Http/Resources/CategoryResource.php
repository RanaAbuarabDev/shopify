<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
           'id' => $this->id,
           'name' => $this->name,
           'description' => $this->description,
           'image' => ImageResource::make($this->mainImage),
           'sub_categories' => CategoryResource::collection($this->subCategories),
           'products_count' => $this->products_count,
       ];

    }
}

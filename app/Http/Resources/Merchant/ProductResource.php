<?php

namespace App\Http\Resources\Merchant;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'price' => $this->price,
            'category' => $this->whenLoaded('category', fn() => CategoryResource::make($this->category)),
            'image' => $this->whenLoaded('mainImage', fn() => ImageResource::make($this->mainImage)),
        ];
    }
}

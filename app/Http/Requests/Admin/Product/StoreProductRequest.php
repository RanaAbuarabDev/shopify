<?php

namespace App\Http\Requests\Admin\Product;

use App\Enums\ImagePositionEnum;
use App\Rules\CheckIsMainRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->where(function ($query) {
                    return $query->where('category_id', $this->category_id);
                }),
            ],
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'images' => ['nullable', 'array', new CheckIsMainRule()],
            'images.*.path' => 'string',
            'images.*.position' => ['string', Rule::enum(ImagePositionEnum::class)],
            'images.*.is_main' => ['boolean'],
        ];
    }
}

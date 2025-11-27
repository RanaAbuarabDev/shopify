<?php

namespace App\Http\Requests\Admin;

use App\Enums\ImagePositionEnum;
use App\Rules\CheckIsMainRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string',
            'images' => ['array', new CheckIsMainRule()],
            'images.*.path' => 'string',
            'images.*.position' => ['string', Rule::enum(ImagePositionEnum::class)],
            'images.*.is_main' => ['boolean'],
        ];

    }
}

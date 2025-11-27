<?php

namespace App\Http\Requests\Merchant\OrderItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required', Rule::in(['cancelled', 'completed', 'in_progress'])]
        ];
    }
}
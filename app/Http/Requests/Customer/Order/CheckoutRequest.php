<?php

namespace App\Http\Requests\Customer\Order;


use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'shipping_address_id' => 'required|exists:shipping_addresses,id',
        ];
    }
}
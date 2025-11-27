<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    public function index(){
        return response()->json([
            'shipping_addresses' => ShippingAddress::where('customer_id', auth()->user()->user_id)->get()
        ]);
    }

    public function store(Request $request){
        $shippingAddress = ShippingAddress::create([
            'customer_id' => auth()->user()->user_id,
            'address' => $request->address,
        ]);

        return response()->json([
            'shipping_address' => $shippingAddress
        ]);
    }
}

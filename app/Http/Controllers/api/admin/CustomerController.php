<?php

namespace App\Http\Controllers\api\admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function addContact(Request $request, Customer $customer)
    {
        $customer->contacts()->create([
            'name' => $request->name,
            'phone' => $request->phone
        ]);
        return ResponseFormatter::success('Contact added successfully', $customer);
    }
}
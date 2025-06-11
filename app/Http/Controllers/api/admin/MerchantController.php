<?php

namespace App\Http\Controllers\api\admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function addContact(Request $request, Merchant $merchant)
    {
        $merchant->createContact($request->name, $request->phone);
        return ResponseFormatter::success('Contact added successfully', $merchant);
    }

    public function updateContact(Request $request, Merchant $merchant, $id)
    {
        $merchant->updateContact($id, $request->name, $request->phone);
        return ResponseFormatter::success('Contact updated successfully', $merchant);
    }

    public function deleteContact(Merchant $merchant, $id)
    {
        $merchant->deleteContact($id);
        return ResponseFormatter::success('Contact deleted successfully', $merchant);
    }

    public function getContact(Merchant $merchant, $id)
    {
        $contact = $merchant->getContact($id);
        return ResponseFormatter::success('Contact retrieved successfully', $contact);
    }
}
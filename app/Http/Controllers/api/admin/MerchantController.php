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
    public function addAddress(Request $request, Merchant $merchant){
        $merchant->createAddress($request->name,$request->country,$request->city,$request->street,$request->house_number);
        return ResponseFormatter::success('Address added successfully', $merchant);
    }
    public function updateAddress(Request $request, Merchant $merchant, $id){
        $merchant->updateAddress($id,$request->name,$request->country,$request->city,$request->street,$request->house_number);
        return ResponseFormatter::success('Address updated successfully', $merchant);
    }
    public function deleteAddress(Merchant $merchant, $id){
        $merchant->deleteAddress($id);
        return ResponseFormatter::success('Address deleted successfully', $merchant);
    }
    public function getAddress(Merchant $merchant, $id){
        $address = $merchant->getAddress($id);
        return ResponseFormatter::success('Address retrieved successfully', $address);
    }
    public function getAddresses(Merchant $merchant){
        $addresses = $merchant->getAddresses();
        return ResponseFormatter::success('Addresses retrieved successfully', $addresses);
    }


}

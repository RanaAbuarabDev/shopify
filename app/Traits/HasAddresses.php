<?php

namespace App\Traits;
use App\Models\Address;

Trait HasAddresses{
    public function addresses(){
        $this->morphMany(Address::class,'addressable');
    }
    public function createAddress($name,$country,$city,$street,$house_number){
       $address= $this->addresses()->create([
            'name' => $name,
            'country' => $country,
            'city' => $city,
            'street' => $street,
            'house_number' => $house_number,
        ]);
      return $address;

    }
    public function updateAddress($id,$name,$country,$city,$street,$house_number){
       $address= $this->addresses()->findOrFail($id);
           $address->update([
            'name' => $name,
            'country' => $country,
            'city' => $city,
            'street' => $street,
            'house_number' => $house_number,
        ]);

    }
    public function deleteAddress($id){
      $address=  $this->addresses()->whereId($id)->delete();
      return $address;
    }
    public function getAddress($id){
        return $this->addresses()->whereId($id)->first();
    }
    public function getAddresses(){
        return $this->addresses()->get();
    }
}

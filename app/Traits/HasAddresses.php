<?php

namespace App\Traits;

use App\Models\Address;

trait HasAddresses
{
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function createAddress($city, $street)
    {
        return $this->addresses()->create([
            'city' => $city,
            'street' => $street,
        ]);
    }

    public function updateAddress($id, $city, $street)
    {
        $address = $this->addresses()->findOrFail($id);
        $address->update([
            'city' => $city,
            'street' => $street,
        ]);
        return $address;
    }

    public function deleteAddress($id)
    {
        $address = $this->addresses()->findOrFail($id);
        $address->delete();
        return $address;
    }

    public function getAddress($id)
    {
        return $this->addresses()->findOrFail($id);
    }

    public function getAddresses()
    {
        return $this->addresses()->get();
    }
}

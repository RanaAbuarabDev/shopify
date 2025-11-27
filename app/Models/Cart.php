<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['customer_id', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);

    }
    public function getTotalPriceAttribute()
    {
        return $this->cartItems->sum('total_price');
    }
    public function getTotalQuantityAttribute()                                      
    {
        return $this->cartItems->sum('quantity');
    }
}

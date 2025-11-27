<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];


    public function orderItems(): HasMany{
        return $this->hasMany(OrderItem::class);
    }

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }
    
    public function shippingAddress() : BelongsTo {
        return $this->belongsTo(ShippingAddress::class);
    }


    public function status(): Attribute
    {
        return Attribute::make(
            get: function(){

                $status = $this->orderItems->pluck('status')->toArray();

                return count(array_unique($status)) == 1 ? $status[0] : 'in_progress';

                // $valueCounts = array_count_values($status);

                // if(isset($valueCounts['pending']) && $valueCounts['pending'] == count($valueCounts)) return 'pending';

                // if(isset($valueCounts['completed']) && $valueCounts['completed'] == count($valueCounts)) return 'completed';

                // return 'in_progress';
            }
        );
    }
}

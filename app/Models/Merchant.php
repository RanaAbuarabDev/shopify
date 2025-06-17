<?php

namespace App\Models;

use App\Traits\HasAddresses;
use App\Traits\HasContacts;
use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasContacts,HasAddresses, HasImages;
    
    public function user(){
        return $this->morphTo(User::class, 'user');
    }
}

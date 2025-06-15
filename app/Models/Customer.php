<?php

namespace App\Models;

use App\Traits\HasAddresses;
use App\Traits\HasContacts;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasContacts,HasAddresses;

    public function user(){
        return $this->morphTo(User::class, 'user');
    }
}

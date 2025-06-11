<?php

namespace App\Models;

use App\Traits\HasContacts;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasContacts;

    public function user(){
        return $this->morphTo(User::class, 'user');
    }
}

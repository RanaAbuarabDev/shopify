<?php

namespace App\Models;

use App\Traits\HasContacts;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasContacts;
    
    public function user(){
        return $this->morphTo(User::class, 'user');
    }
}

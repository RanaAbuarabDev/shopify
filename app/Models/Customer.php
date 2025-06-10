<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user(){
        return $this->morphTo(User::class, 'user');
    }
}

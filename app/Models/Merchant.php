<?php

namespace App\Models;

use App\Traits\HasAddresses;
use App\Traits\HasContacts;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasContacts,HasAddresses;
    protected $fillable = ['name','email','phone','address'];
    public function user(){
        return $this->morphOne(User::class, 'user');
    }

}

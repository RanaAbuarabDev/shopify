<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login($email, $password, $userType){
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            /** @var User $user */
            $user =Auth::user();
            if($user->user_type != $userType){
                return [false, null, null, null];
            }
            $token = $user->createToken('authToken')->plainTextToken;

            return [true, $token,'Bearer',$user];
        }
    }
}
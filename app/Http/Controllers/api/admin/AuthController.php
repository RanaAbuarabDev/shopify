<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            /** @var User $user */
            $user=Auth::user();
            if($user->user_type != (new Admin)->getMorphClass()){
                return ResponseFormatter::error('Unauthorized', 401);
            }
            $token = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success('Login successful', [
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }

        return ResponseFormatter::error('Invalid credentials', 401);
    }


}

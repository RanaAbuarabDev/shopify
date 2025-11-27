<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {

    }
    public function login(LoginRequest $request){

        $credentials = $request->only('email', 'password');
        [$success, $token, $token_type, $user] = $this->authService->login($credentials['email'], $credentials['password'], (new Admin())->getMorphClass());
        if($success){
            return ResponseFormatter::success('login success', [
                'token' => $token,
                'token_type' => $token_type,
                'user' => $user,
            ]);
        }
        return ResponseFormatter::error('unauthorized',401);
    }





}

<?php

namespace App\Http\Controllers\api\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Merchant;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Merchant\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;
use App\Services\AuthService;

class AuthController extends Controller
{

    public function __construct(public AuthService $authService)
    {
        
    }
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        [$merchant, $token] = DB::transaction(function () use ($data) {
            $merchant = Merchant::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'] ?? null,
                'phone' => $data['phone'] ?? null,
            ]);

            $merchant->user()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $token = $merchant->user->createToken('authToken')->plainTextToken;

            return [$merchant, $token];
        });


        return ResponseFormatter::success('Merchant created successfully', [
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $merchant->user
        ]);
    }
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        [$success, $token, $token_type, $user] = $this->authService->login($credentials['email'], $credentials['password'], (new Merchant())->getMorphClass());
        if($success){
            return ResponseFormatter::success('login success', [
                'token' => $token,
                'token_type' => $token_type,
                'user' => $user,
            ]);
            return ResponseFormatter::error('unauthorized',401);} 
        }

}

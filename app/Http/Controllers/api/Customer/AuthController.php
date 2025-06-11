<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Merchant\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{

    public function __construct(public AuthService $authService)
    {
        
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        [$success, $token, $token_type, $user] = $this->authService->login($credentials['email'], $credentials['password'], (new Customer())->getMorphClass());
        if($success){
            return ResponseFormatter::success('login success', [
                'token' => $token,
                'token_type' => $token_type,
                'user' => $user,
            ]);
        }
        return ResponseFormatter::error('unauthorized',401);
    }
    public function Register(RegisterRequest $request)
    {
        $data = $request->validated();
        [$customer, $token] = DB::transaction(function () use ($data) {
            $customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);
            $customer->user()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password'=>$data['password'],
            ]);
            $token = $customer->user->createToken('authToken')->plainTextToken;
            return [$customer, $token];
        });
        return ResponseFormatter::success('Register success',[
            'token' => $token,
            'token_type' => 'Bearer',
            'user'=>$customer->user,
        ]);
            }
}

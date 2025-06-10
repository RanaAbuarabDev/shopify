<?php

namespace App\Http\Controllers\api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Merchant\RegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            /** @var User $user */
            $user =Auth::user();
            if($user->user_type != (new Customer)->getMorphClass()){
                return ResponseFormatter::error('unauthorized',401);
            }
            $token = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success('login success',[
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }
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

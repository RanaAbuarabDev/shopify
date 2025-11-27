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
use Illuminate\Support\Facades\Log;


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
        try {

            DB::beginTransaction();


            $customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone']??null,
                'address' => $data['address']??null,
            ]);
            $result = $this->authService->register($data['name'], $data['email'], $data['password'], $customer);
            DB::commit();

            if (!$result) {
                return ResponseFormatter::error(['error' => 'Something went wrong'], 500);
            }
            return ResponseFormatter::success('Customer created successfully', [
                'token' => $result['token'],
                'token_type' => $result['token_type'],
                'user' => $result['user'],

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::error('Merchant registration failed: ' . $e->getMessage());
            return ResponseFormatter::error(['error' => 'Something went wrong'], 500);
        }

    }}

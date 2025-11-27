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
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function __construct(public AuthService $authService)
    {

    }

    public function register(RegisterRequest $request)
    {
        try {


        $data = $request->validated();

        DB::transaction(function () use ($data) {
        $merchant = Merchant::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'] ?? null,
            'phone' => $data['phone'] ?? null,
        ]);

        $result = $this->authService->register($data['name'], $data['email'], $data['password'], $merchant);


        if (!$result) {
            return ResponseFormatter::error(['error' => 'Something went wrong'], 500);
        }
            return ResponseFormatter::success('Merchant created successfully', [
                'token' => $result['token'],
                'token_type' => $result['token_type'],
                'user' => $result['user'],
            ]);});}
        catch (\Exception $e) {
            Log::error('Merchant registration failed: ' . $e->getMessage());
            dd($e->getMessage());
            return ResponseFormatter::error(['error' => 'Something went wrong'], 500);
        }


    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        [$success, $token, $token_type, $user] = $this->authService->login($credentials['email'], $credentials['password'], (new Merchant())->getMorphClass());
        if ($success) {
            return ResponseFormatter::success('login success', [
                'token' => $token,
                'token_type' => $token_type,
                'user' => $user,
            ]);
            return ResponseFormatter::error('unauthorized', 401);
        }
    }

}

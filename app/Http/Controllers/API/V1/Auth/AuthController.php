<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Auth\LoginRequest;
use App\Http\Requests\V1\Auth\RegisterRequest;
use App\Services\V1\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected AuthService $authService)
    {
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request);

        return $user;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request);

        return $user;
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return [
            'message' => 'successfully logged out'
        ];
    }
}

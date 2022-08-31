<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\CallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\JWTAuthService;
use Illuminate\Http\Request;

class JWTAuthController extends Controller
{
    use CallableIntercept;

    protected AuthServiceInterface $authService;

    public function __construct(JWTAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use ($request) {
            return $this->authService->login($request->only(['email', 'password']));
        });
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use ($request) {
            $this->authService->logout();

            return true;
        });
    }
}

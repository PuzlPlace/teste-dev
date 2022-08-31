<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;
use JetBrains\PhpStorm\ArrayShape;
use Throwable;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthService extends Contracts\JWTAuthService
{

    /**
     * @throws Throwable
     */
    function login(array $credentials) : array
    {
        throw_if(!$token = auth()->attempt($credentials), new UnauthorizedException('User not authorized!'));

        return $this->returnTokenResult($token);
    }

    function logout()
    {
        auth()->logout();
    }

    function me(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->user();
    }

    function refresh() : array
    {
        return $this->returnTokenResult(auth()->refresh());
    }

    protected function returnTokenResult($token) : array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => \auth()->user()
        ];
    }
}

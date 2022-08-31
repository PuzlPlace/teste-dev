<?php

namespace App\Services\Contracts;

abstract class JWTAuthService implements AuthServiceInterface
{

    abstract function login(array $credentials) : array;

    abstract function logout();

    abstract function me() : ?\Illuminate\Contracts\Auth\Authenticatable;

    abstract function refresh() : array;

    abstract protected function returnTokenResult($token) : array;
}

<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    function login(array $credentials);

    function logout();

    function me();

    function refresh();
}

<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserManagerInterface
{
    function getAll() : Collection;

    function findById(string $uuid) : ?User;

    function create(array $payload) : User;

    function update(User $user, array $payload) : bool;

    function delete(string $uuid) : bool;
}

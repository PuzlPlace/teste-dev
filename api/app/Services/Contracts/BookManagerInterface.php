<?php

namespace App\Services\Contracts;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookManagerInterface
{
    function getAllCategories() : Collection;

    function getAll($categoryId = null,
                    $fileType = null,
                    $bookName = null,
                    $regsByPage = 5,
                    $page = 1) : array;

    function findByCode(string $code) : ?Book;

    function create(array $payload) : Book;

    function update(Book $book, array $payload) : bool;

    function delete(string $code) : bool;
}

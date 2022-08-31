<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class BookManagerService implements Contracts\BookManagerInterface
{
    function getAllCategories(): Collection
    {
        return Category::query()->orderBy('name')->get();
    }

    function getAll($categoryId = null,
                    $fileType = null,
                    $bookName = null,
                    $regsByPage = 5,
                    $page = 1): array
    {
        $query = Book::query()->with('category')->orderByDesc('created_at');

        if($categoryId && $categoryId != 0)
            $query->where('categories_id', '=', $categoryId);

        if($fileType && $fileType != '0')
            $query->where('file_type', '=', $fileType);

        if($bookName && $bookName != 'null')
            $query->where('name', 'like', "%$bookName%");

        $paginador = $query->paginate($regsByPage);

        $totalPages = $paginador->lastPage();

        $totalRegs = $paginador->total();

        if($page > $totalPages)
            $page = $totalPages;

        return [
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'totalRegs' => $totalRegs,
            'books' => $query->forPage($page, $regsByPage)->get()
        ];
    }

    function findByCode(string $code): ?Book
    {
        return Book::query()->with('category')->whereCode($code)->first();
    }

    function create(array $payload): Book
    {
        $book = new Book();

        $book->name = $payload['name'];
        $book->author = $payload['author'];
        $book->categories_id = $payload['categories_id'];
        $book->file_type = $payload['file_type'];
        $book->size_or_weight = $payload['size_or_weight'];
        $book->save();

        return $book;
    }

    function update(Book $book, array $payload): bool
    {
        return $book->update($payload);
    }

    /**
     * @throws \Throwable
     */
    function delete(string $code): bool
    {
        $book = $this->findByCode($code);

        throw_if(!$book, new \Exception('Book not found!'));

        return $book->delete();
    }
}

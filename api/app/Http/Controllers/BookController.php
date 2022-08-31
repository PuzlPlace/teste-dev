<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostAndPutRequest;
use App\Http\Resources\AllBooksResource;
use App\Http\Resources\BookForUpdateResource;
use App\Services\Contracts\BookManagerInterface;
use App\Services\Contracts\UserManagerInterface;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    use CallableIntercept;

    protected BookManagerInterface $bookManagerService;

    public function __construct(BookManagerInterface $bookManagerService)
    {
        $this->bookManagerService = $bookManagerService;
    }

    public function getAllCategories(): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () {
            return[
                'categories' => $this->bookManagerService->getAllCategories()
            ];
        });
    }

    public function getAllBooks($categoryId = null,
                                $fileType = null,
                                $bookName = null,
                                $regsByPage = 5,
                                $page = 1): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($categoryId, $fileType, $bookName, $regsByPage, $page){
            $result = $this->bookManagerService->getAll($categoryId, $fileType, $bookName, $regsByPage, $page);

            $books = AllBooksResource::collection(Arr::get($result, 'books'));

            $result = Arr::set($result, 'books', $books);

            return[
                'result' => $result
            ];
        });
    }

    public function findBookByCode($code): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($code){
            return [
                'book' => new BookForUpdateResource($this->bookManagerService->findByCode($code))
            ];
        });
    }

    public function createNewBook(BookPostAndPutRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($request){
            $payload = $request->validated();

            return [
                'book' => $this->bookManagerService->create($payload)
            ];
        });
    }

    public function updateBook(BookPostAndPutRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($request, $id){
            $book = $this->bookManagerService->findByCode($id);

            $payload = $request->validated();

            return [
                'updated' => $this->bookManagerService->update($book, $payload)
            ];
        });
    }

    public function deleteBook($id): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($id){
            return [
                'deleted' => $this->bookManagerService->delete($id)
            ];
        });
    }
}

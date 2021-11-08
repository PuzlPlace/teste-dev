<?php


namespace App\Repositories;


use App\Models\Livro;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Http\JsonResponse;

interface LivroRepository
{
    /**
     * @param array $values
     * @return JsonResponse
     */
    public function store(array $values): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function update(array $values,int $id):JsonResponse;

    /**
     * @param array|null $rules
     * @return JsonResponse
     */
    public function all(array $rules = null):JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function get(int $id):JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id):JsonResponse;
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Services\LivroService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    private LivroService $livroService;

    /**
     * AuthController constructor.
     * @param LivroService $livroService
     */
    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request):JsonResponse
    {
        return $this->livroService->all($request->all() ?? null);
    }

    /**
     * @param LivroRequest $request
     * @return JsonResponse
     */
    public function store(LivroRequest $request): JsonResponse
    {
        return $this->livroService->store($request->validated());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id):JsonResponse
    {
        return $this->livroService->get($id);
    }

    /**
     * @param LivroRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(LivroRequest $request, int $id):JsonResponse
    {
        return $this->livroService->update($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id):JsonResponse
    {
        return $this->livroService->destroy($id);
    }
}

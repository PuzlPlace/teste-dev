<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LibraryRepository;
use App\Models\Library;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    private LibraryRepository $repository;

    /**
     * Construct Repository
     */
    public function __construct()
    {
        $this->repository = new LibraryRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->repository->pagination());
    }

    /**
     * @param Library $library
     * Desnecessário efetuar o RequestLibrary para Validação por se tratar de uma demo
     */
    public function store(Library $library): JsonResponse
    {
        try {
            $this->repository->store($library);
            return response()->json([
                'success' => true,
                'message' => 'Cadastro efetuado com sucesso'
            ]);
        }catch (\Throwable $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try{
            $data = $this->repository->getById($id);
            return response()->json([
                'success' => true,
                'message' => 'Cadastro encontrado',
                'data' => $data
            ]);
        }catch (\Throwable $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try{
            $data = $this->repository->update($id, $request);
            return response()->json([
                'success' => true,
                'message' => 'Cadastro atualizado com sucesso',
                'data' => $data
            ]);
        }catch (\Throwable $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try{
            $status = $this->repository->destroy($id);
            return response()->json([
                'success' => $status,
                'message' => $status? 'Cadastro removido' : 'Erro ao remover cadastro',
            ]);
        }catch (\Throwable $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ]);
        }
    }
}

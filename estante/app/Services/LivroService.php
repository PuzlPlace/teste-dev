<?php


namespace App\Services;


use App\Models\Livro;
use App\Repositories\LivroRepository;
use Illuminate\Http\JsonResponse;

class LivroService implements LivroRepository
{


    public function store(array $values): JsonResponse
    {
        try {
            return send_response('Criado com sucesso!', Livro::create($values), 201);
        } catch (\Exception $exception) {
            return send_error('Erro ao criar o arquivo!', $exception->getMessage(), 422);
        }
    }

    public function update(array $values, int $id): JsonResponse
    {
        try {
            return send_response('Atualizado com sucesso!', Livro::findOrFail($id)->update($values), 200);
        } catch (\Exception $exception) {
            return send_error('Erro ao atualizar o livro ' . $values['nome'] . '!', $exception->getMessage(), 422);
        }
    }

    /**
     * @param array|null $rules
     * @return JsonResponse
     */
    public function all(array $rules = null): JsonResponse
    {
        $response = [];
        if (in_array(!null, $rules)) {
            foreach ($rules as $key => $value) {
                $response = Livro::where($key, 'like', '%' . $value . '%')->paginate(count(Livro::all()) / 4 >= 1 ? count(Livro::all()) / 4 : 4);
            }
        } else {
            return send_response(null, Livro::all(), 200);
        }
        try {
            if ($rules != null && count(Livro::all()) > 0) {
                if (count($response) > 0) {
                    return send_response(null, $response, 200);
                } else {
                    return send_error('Erro!', 'Não há resultados a partir da sua busca.', 422);
                }
            } else if ($rules == null && count(Livro::all()) > 0) {
                return send_response(null, Livro::all(), 200);
            } else {
                return send_response('Não há livros cadastrados', null, 200);
            }
        } catch (\Exception $exception) {
            return send_error('Erro!', $exception->getMessage(), 422);
        }
    }

    public function get(int $id): JsonResponse
    {
        try {
            return send_response(null, Livro::findOrFail($id), 200);
        } catch (\Exception $exception) {
            return send_error('Erro ao buscar o livro', $exception->getMessage(), 422);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            return send_response('Livro deletado com sucesso!', Livro::findOrFail($id)->destroy($id), 200);
        } catch (\Exception $exception) {
            return send_error('Erro ao deletar o livro', $exception->getMessage(), 422);
        }
    }
}

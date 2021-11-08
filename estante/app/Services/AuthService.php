<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Diff\Exception;

class AuthService
{

    public function login($credentials): JsonResponse
    {
        $user = User::where('email',$credentials['email'])->get()->first();
        if($user == null){
            return send_error('Usuário não cadastrado!', null, 422);
        }else if($user->email != $credentials['email'] || !Hash::check($credentials['password'], $user->password)){
            return send_error('Não autorizado', 'Email ou senha inválidos!', 422);
        }else {
            try {
                $token = auth('api')->attempt($credentials);
                return send_response('', ['user' => $user, 'token' => $this->respondWithToken($token)]);
            } catch (\Exception $exception) {
                return send_error('Não autorizado', $exception->getMessage(), 422);
            }
        }
    }

    public function store($cretentials):JsonResponse
    {
        try {
            $values = [
                'name' => $cretentials['name'],
                'email' => $cretentials['email'],
                'password' => Hash::make($cretentials['password'])
            ];
            $user = User::create($values);
            return send_response('Usuário cadastrado com sucesso!', $user, 201);
        }catch(\Exception $exception){
            return send_error('Erro ao cadastrar o usuário', $exception->getMessage(), 422);
        }
    }

    public function logout()
    {
        try {
            auth('api')->logout();
            return send_response('logout feito com sucesso', null, 200);
        }catch(Exception $exception){
            return send_error('Erro ao efetuar o logout', null, 404);
        }
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 360
        ]);
    }
}

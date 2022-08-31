<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostAndPutRequest;
use App\Services\Contracts\UserManagerInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CallableIntercept;

    protected UserManagerInterface $userManagerService;

    public function __construct(UserManagerInterface $userManagerService)
    {
        $this->userManagerService = $userManagerService;
    }

    public function getAllUsers(): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () {
            return[
                'users' => $this->userManagerService->getAll()
            ];
        });
    }

    public function createNewUser(UserPostAndPutRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($request){
            return [
                'user' => $this->userManagerService->create($request->only('name', 'email', 'password'))
            ];
        });
    }

    public function updateUser(UserPostAndPutRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($request, $id){
            $user = $this->userManagerService->findById($id);

            return [
                'updated' => $this->userManagerService->update($user, $request->only('name', 'email', 'password'))
            ];
        });
    }

    public function deleteUser($id): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () use($id){
            return [
                'deleted' => $this->userManagerService->delete($id)
            ];
        });
    }
}

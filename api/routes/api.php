<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/teste', function(){
    return 'teste';
});

Route::post('/login', [\App\Http\Controllers\Auth\JWTAuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(\App\Http\Controllers\UserController::class)->group(function (){
        Route::get('/users/all', 'getAllUsers');
        Route::post('/users/store', 'createNewUser');
        Route::put('/users/update/{id}', 'updateUser');
        Route::delete('/users/delete/{id}', 'deleteUser');
    });

    Route::controller(\App\Http\Controllers\BookController::class)->group(function (){
        Route::get('/books/categories/all', 'getAllCategories');
        Route::get('/books/all/{categoryId?}/{fileType?}/{bookName?}/{regsByPage?}/{page?}', 'getAllBooks');
        Route::get('/books/show/{id}', 'findBookByCode');
        Route::post('/books/store', 'createNewBook');
        Route::put('/books/update/{id}', 'updateBook');
        Route::delete('/books/delete/{id}', 'deleteBook');
    });

    Route::post('/logout', [\App\Http\Controllers\Auth\JWTAuthController::class, 'logout']);
});

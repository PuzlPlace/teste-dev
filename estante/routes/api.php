<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'store']);

Route::group(['middleware' => ['api']], function () {
   Route::get('/listar', [LivroController::class, 'index']);
   Route::post('/inserir', [LivroController::class, 'store']);
   Route::group(['prefix' => '{id}'], function(){
      Route::get('', [LivroController::class, 'show']);
      Route::put('', [LivroController::class, 'update']);
      Route::delete('', [LivroController::class, 'destroy']);
   });
});

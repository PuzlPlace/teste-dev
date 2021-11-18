<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['namespace'=>'App\Http\Controllers\Auth'], function(){
    Route::post('/login', 'AuthenticatedSessionController@store')
                ->middleware('guest');
            
Route::get('/login', 'AuthenticatedSessionController@create')
->middleware('guest')
->name('login');

Route::get('/logout', 'AuthenticatedSessionController@destroy')

->name('logout');

});
Route::get('/', function () {
    return view('welcome');
});




Route::group(['namespace'=>'App\Http\Controllers'], function(){
    Route::group(['middleware'=>['auth']],function(){
     
        Route::get('/dashboard', 'LivrosController@index')->name('dashboard');
        Route::resource('/livros', 'LivrosController');
        Route::resource('/categorias', 'Categorias');
    
        
    });

});

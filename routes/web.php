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

Route::get('/', function () {
    return view('home');
});

Route::namespace('\App\Http\Controllers')->group(function () {
    Route::resources([
        'form' => 'FormController',
        'categories' => 'CategoriesController',
    ]);
});

Route::post('/filtered', [App\Http\Controllers\FormController::class, 'filtered'])->name('filtered');
Route::get('/form/edit/{name?}', [App\Http\Controllers\FormController::class, 'edit'])->name('edit');

Route::resource('getBooks', '\App\Http\Controllers\BooksController');
Route::delete('getBooks/{id}', 'App\Http\Controllers\BooksController@destroy');

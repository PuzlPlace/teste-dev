<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/books/list', function () {
    return Inertia::render('Book/Books');
})->middleware(['auth', 'verified'])->name('books');

Route::middleware('auth')->group(function () {
    
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/book/{id}', [BookController::class, 'find']);

    Route::get('/books/list', function () {
        return Inertia::render('Book/Books');
    })->name('books');

    Route::get('/books/add', function () {
        return Inertia::render('Book/Add');
    })->name('add.book');

    Route::post('/books/add', [BookController::class, 'add']);

    Route::get('/books/edit', function () {
        return Inertia::render('Book/EditList');
    })->name('edit.books');

    Route::get('/books/edit/{id}', function (string $id) {
        return Inertia::render('Book/Edit', ['id' => $id]);
    })->name('edit.book');

    Route::put('/books/edit/{id}', [BookController::class, 'edit']);

    Route::get('/books/delete', function () {
        return Inertia::render('Book/Delete');
    })->name('del.book');

    Route::delete('/books/delete/{id}', [BookController::class, 'delete']);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

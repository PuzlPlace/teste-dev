<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return Inertia::render('Book/Books', [
            'livros' => $books,
        ]);
    }

    public function add(Request $request){

        $request->validate([
            'nome' => 'required',
            'autor' => 'required',
            'categoria' => 'required',
            'codigo' => 'required|unique:books',
            'tipo' => 'required',
            'tamanho' => 'required',
        ]);

        $book = Book::create($request->all());

        return response()->json(['livro' => $book], 201);
    }
}

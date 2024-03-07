<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return $books;
    }

    public function find($id)
    {
        $book = Book::find($id);
        return $book;
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

    public function edit(Request $request, $id){
    
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['mensagem' => 'Livro não encontrado'], 404);
        }

        $book->update($request->all());
        return response()->json(['livro' => $book], 201);
    }   

    public function delete($id){
    
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['mensagem' => 'Livro não encontrado'], 404);
        }

        $book->delete();

        return response()->json(['mensagem' => 'Livro deletado com sucesso']);
    }   
}

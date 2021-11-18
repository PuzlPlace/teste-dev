<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\LivrosCategorias;
use Illuminate\Facades\File;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;
class LivrosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
 
    $livros = Livros::all();
  
    return view('livros.index', compact('livros'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categorias = LivrosCategorias::all();

        return view('livros.create', compact('categorias'));
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $livro = new Livros();
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->tipo = $request->tipo;
        $livro->editora = $request->editora;
        $livro->ano = $request->ano;
        $livro->paginas = $request->paginas;
        $livro->descricao = $request->descricao;
        $livro->id_categoria = $request->id_categoria;
      
     
         if(!empty($request->imagem)){
            $extensao = $request->imagem->extension();
            $name = uniqid(date('H'));
            $nomeImagem = "{$name}.{$extensao}";
         $request->imagem->storeAs('photos', $nomeImagem);
         $livro->imagem =$nomeImagem;
    }
     
         if(  $livro->save() == true)
        {
        
            toast('Livro cadastrado com Sucesso','success');
            return redirect()->route('livros.index');
   
        
        }
        else
        {
            toast('Erro ao Cadastrar','error');
            return redirect()->route('livros.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function show(Livros $livros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function edit(Livros $livros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livros $livros)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livros  $livros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livros $livros)
    {
        //
    }
}

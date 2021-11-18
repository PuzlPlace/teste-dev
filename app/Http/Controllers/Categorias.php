<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LivrosCategorias;
class Categorias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $categorias = LivrosCategorias::all();
     $livros = LivrosCategorias::all();
     return view('categoria.index', compact('categorias','livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if($request->categoria == ''){
        toast('O nome da Categoria não pode ser Vasio ','error');
        return redirect()->route('categorias.index');

   }
    $categorias = new LivrosCategorias();

    $categorias->categoria = $request->categoria;
    if($categorias->save() == true){
    toast('Categoria Adicionada com Sucesso!','success');
    
    return redirect()->back();

    
    }else{
    toast('Erro ao Cadastrar Categoria','error');

    };
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

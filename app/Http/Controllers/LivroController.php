<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LivroController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $livrosQuery = Livro::query();

        if ($request->has('categoria')) {
            $livrosQuery->where('categoria', $request->categoria);
        }

        if ($request->has('tipo')) {
            $livrosQuery->where('tipo', $request->tipo);
        }

        if ($request->has('nome')) {
            $livrosQuery->where('nome', 'like', '%' . $request->nome . '%');
        }
        
        if ($request->has('periodo_inicio') && $request->has('periodo_fim')) {
            $periodoInicio = Carbon::parse($request->periodo_inicio);
            $periodoFim = Carbon::parse($request->periodo_fim);
            $livrosQuery->whereBetween('created_at', [$periodoInicio, $periodoFim]);
        }
        
        $livros = $livrosQuery->get();

        return response()->json($livros, 200, [], JSON_PRETTY_PRINT);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'autor' => 'required',
            'categoria' => 'required',
            'codigo' => 'required|unique:livros',
            'tipo' => 'required|in:digital,físico',
            'tamanho' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $livro = Livro::create($request->all());
        return response()->json($livro, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livro = Livro::findOrFail($id);
        return response()->json($livro);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $livro = Livro::findOrFail($id);
        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $livro = Livro::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'autor' => 'required',
            'categoria' => 'required',
            'codigo' => 'required|unique:livros,codigo,' . $id,
            'tipo' => 'required|in:digital,físico',
            'tamanho' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $livro->update($request->all());
        return response()->json($livro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Livro::destroy($id);
        return response()->json(null, 204);
    }
}

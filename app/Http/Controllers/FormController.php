<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $perPage = 10;

    public function index()
    {
        //

        $title = 'Index';
        return view('form', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $books = new Books();
            $books -> author = $request -> author;
            $books -> category = $request -> category;
            $books -> code = $request -> code;
            $books -> length = $request -> length;
            $books -> name = $request -> name;
            $books -> type = $request -> type;
            $books -> save();

            $result = array('stats' => true, 'message' => 'Livro cadastrado com sucesso!');
        } catch (\Throwable $th) {
            $result = array('stats' => true, 'message' => $th->getMessage());
        }

        return $result;
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
        $result = Books::find($id);
        return response()->json($result);
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
        $title = 'Index';
        return view('form', compact('title'));
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

        try {
            $books = books::find($request -> id);
            $books -> author = $request -> author;
            $books -> category = $request -> category;
            $books -> code = $request -> code;
            $books -> length = $request -> length;
            $books -> name = $request -> name;
            $books -> type = $request -> type;
            $books -> update();
            $result = array('stats' => true, 'message' => 'Livro atualizado com sucesso!');
        } catch (\Throwable $th) {
            $result = array('stats' => true, 'message' => $th->getMessage());
        }

        return $result;
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

    public function filtered(Request $request)
    {
        if( !empty($request -> type) && !empty($request -> category) ){
            $result  = Books::where('type', $request -> type)->where('category', $request -> category)->whereDate('updated_at', '=', $request->dataCadastro)->orderBy('id','asc')->select("*")->paginate($this->perPage);
        }else if(!empty($request -> type)){
            $result  = Books::where('type', $request -> type)->whereDate('updated_at', '=', $request->dataCadastro)->orderBy('id','asc')->select("*")->paginate($this->perPage);
        }else if(!empty($request -> category)) {
            $result  = Books::where('category', $request -> category)->whereDate('updated_at', '=', $request->dataCadastro)->orderBy('id','asc')->select("*")->paginate($this->perPage);
        }

        return response()->json($result);
    }
}

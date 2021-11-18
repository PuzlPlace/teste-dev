
@extends('layouts.master')

@section('content')
<div class="page-header">
    <h4 class="page-title">Livros</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('dashboard')}}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
     
        <li class="nav-item">
            <a href="#">Adicionar</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <a href="{{route('livros.index')}}" > Listar Livro</a>
    </ul>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Cadastro de Livros</div>
        </div>
        <div class="card-body">
            <div class="row">
             
                <div class="modal-body">
                    <form  class="form-control" action="{{route('livros.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
 
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Titulo </label>
                                    <input type="text" class="form-control" name="titulo" placeholder="Digite: o Titulo">
                                    @error('titulo') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nome do Autor</label>
                                    <input type="text" class="form-control" name="autor" placeholder="Digite: Nome do Autor">
                                    @error('autor') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                              
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Formato </label>
                                    <select class="form-control" name="tipo">
                                       <option value="1">Fisico</option>
                                       <option value="0">Digital</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Editora </label>
                                    <input type="text" class="form-control" name="editora"  placeholder="Digite: o nome da Editora">
                                    @error('editora') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Ano do Lançamento</label>
                                    <input type="text" class="form-control" name="ano"  placeholder="Digite: Ano de Lançamento ">
                                    @error('ano') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                              
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Paginas</label>
                                    <input type="text" class="form-control" name="paginas" placeholder="Digite: Numeros de Paginas">
                                    @error('paginas') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                              
                            </div>
    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Descrição</label>
                                    <textarea class="form-control" name="descricao" rows="3" cols="20" style="min-width: 100%"></textarea>
                                   
                                    @error('descricao') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Selecione um Arquivo de Imagen</label>
                                <input type="file" class="form-control" name="imagem">
                                @error('imagem') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Categoria </label>
                                <select class="form-control" name="id_categoria">
                                    @if (!empty($categorias))
                                   @foreach ($categorias as $categoria) 
                                   <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                   @endforeach
                                   @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <br>
                                <button class="btn btn-success">Cadastrar</button>
                            </div>
                        </div>
                       
                    </div>
                    </form>
                </div>
    </div>
</div>
</div>
</div>
@endsection

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
        <a href="{{route('livros.index')}}" > Listar categoria</a>
    </ul>
  
</div>

@livewire('categorias' , ['categorias' => $categorias])

@endsection
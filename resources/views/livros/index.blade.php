
@extends('layouts.master')

@section('content')
<div class="page-header">
    <h4 class="page-title"></h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Dashboard</a>
        </li>
    
    </ul>
</div>
@livewire('livros',['livros'=>$livros])
@endsection












@extends('layouts.app')

@section('content')
    <div id="app">
        <livros-edit :livro="{{ json_encode($livro) }}"></livros-edit>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection

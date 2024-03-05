@extends('layouts.app')

@section('content')
    <div id="app">
        <livros-list></livros-list>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
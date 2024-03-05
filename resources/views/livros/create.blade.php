@extends('layouts.app')

@section('content')
    <div id="app">
        <livros-create></livros-create>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection

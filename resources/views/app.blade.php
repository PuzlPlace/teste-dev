<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>

<body>
    {{-- HTML element to mount the Vue application --}}
    <div id="app"></div>
    {{-- including the app.js file --}}
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>

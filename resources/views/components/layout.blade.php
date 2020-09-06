<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BetterRX</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,300,400,500,600,700,900&display=swap" rel="stylesheet">
    <link href={{ asset('css/app.css') }} rel="stylesheet"/>

    <link rel="shortcut icon" href="{{ asset('images/favicon-1.ico') }}">

    @stack('scripts')

    {{ $head ?? '' }}
</head>
<body class="bg-betterrx">
<div id="app">
    @include('partials.header')

    {{ $slot }}
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

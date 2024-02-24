<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Page Builder') }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/page-builder/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page-builder/css/editor.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@furcan/iconpicker@1.5.0/dist/iconpicker-1.5.0.css" /> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@furcan/iconpicker@1.5.0/dist/iconpicker-1.5.0.min.js"></script> --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('assets/page-builder/css/layout.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;600&family=Lobster&family=Playfair+Display&family=Raleway&family=Cutive+Mono&display=swap"
          rel="stylesheet">

    @vite(['resources/js/app.js'])
</head>
<body>
<div id="app">
    <page-builder v-bind:page="{{ $page }}" />
</div>
</body>
</html>

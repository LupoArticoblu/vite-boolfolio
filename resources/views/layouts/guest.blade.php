<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Boolfolio</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/scss/appVue.scss', 'resources/js/appVue.js'])
    </head>
    <body>
        {{-- @if (Auth::check()) 
            @include('admin.partials.header')            
            @else
            
            @endif --}}
        

        @yield('content')
    </body>
</html>
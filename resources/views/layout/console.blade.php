<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Recipe</title>

        <link rel="stylesheet" href="{{ asset('app.css') }}">
        <script src="{{ asset('app.js') }}"></script>
        
    </head>
    <body>

        <header>
            <h1>Recipe Console</h1>

            @if (Auth::check())
                You are logged in as {{ auth()->user()->first }} {{ auth()->user()->last }} |
                <a href="{{ route('console.logout') }}">Log Out</a> | 
                <a href="{{ route('console.dashboard') }}">Dashboard</a> | 
                <a href="{{ route('home') }}">Website Home Page</a>
            @else
                <a href="{{ route('home') }}">Return to My Recipe</a>
            @endif
        </header>

        <hr>

        @if (session()->has('message'))
            <div class="flash-message">
                <div>{{ session()->get('message') }}</div>
            </div>
        @endif

        @yield ('content')

    </body>
</html>
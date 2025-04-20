@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
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
    <h1>My Recipe!</h1>
</header>

<hr>

@yield('content')

<hr>

<footer>
    Footer Text | 
    Copyright {{ date('Y') }}

    <br>

    @if (Auth::check())
        You are logged in as {{ auth()->user()->first }} {{ auth()->user()->last }} | 
        <a href="{{ route('logout') }}">Log Out</a> | 
        @if (auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        @else
            <a href="{{ route('dashboard') }}">User Dashboard</a>
        @endif
    @else
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Register</a>
    @endif
</footer>

</body>
</html>


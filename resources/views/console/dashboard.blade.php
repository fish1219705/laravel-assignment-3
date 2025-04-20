@extends ('layout.console')

@section ('content')

<section>

    <ul id="dashboard">
        <li><a href="{{ route('recipes.index') }}">Manage Recipes</a></li>
        <li><a href="{{ route('console.users.list') }}">Manage Users</a></li>
        <li><a href="{{ route('console.logout') }}">Log Out</a></li>
    </ul>

</section>

@endsection

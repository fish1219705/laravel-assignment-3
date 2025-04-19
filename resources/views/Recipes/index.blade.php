@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@extends('layout')

@section('content')
    <h1>All Recipes</h1>

    <a href="{{ route('recipes.create') }}">➕ Add New Recipe</a>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        @foreach ($recipes as $recipe)
            <div style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 10px;">
                <h3>{{ $recipe->recipe_name }}</h3>

                @if($recipe->photo)
                    <img src="{{ asset('storage/' . $recipe->photo) }}" width="100%" alt="Photo of {{ $recipe->recipe_name }}">
                @endif

                <p><strong>Prep Time:</strong> {{ $recipe->prep_time }} minutes</p>
                <p><strong>Servings:</strong> {{ $recipe->servings }}</p>

                <a href="{{ route('recipes.show', $recipe->id) }}">👀 View</a> |
                <a href="{{ route('recipes.edit', $recipe->id) }}">✏️ Edit</a> |
                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">❌ Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection



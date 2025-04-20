@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $recipe->recipe_name }}</h1>
    <p>{{ $recipe->instructions }}</p>
    <p><strong>Prep Time:</strong> {{ $recipe->prep_time ?? 'N/A' }} minutes</p>
    <p><strong>Servings:</strong> {{ $recipe->servings ?? 'N/A' }}</p>
    @if($recipe->photo)
        <img src="{{ asset('storage/' . $recipe->photo) }}" width="200" alt="Photo of {{ $recipe->recipe_name }}">
    @endif
    <h3>Ingredients:</h3>
    <ul>
        @foreach($recipe->ingredients as $ingredient)
            <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
        @endforeach
    </ul>
</div>
@endsection

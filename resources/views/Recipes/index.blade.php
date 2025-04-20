@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Recipes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('recipes.submit') }}" class="btn btn-primary mb-3">Submit New Recipe</a>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        @foreach ($recipes as $recipe)
            <div style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 10px;">
                <h3>{{ $recipe->recipe_name }}</h3>

                @if($recipe->photo)
                    <img src="{{ asset('storage/' . $recipe->photo) }}" width="100%" alt="Photo of {{ $recipe->recipe_name }}">
                @endif

                <p><strong>Prep Time:</strong> {{ $recipe->prep_time ?? 'N/A' }} minutes</p>
                <p><strong>Servings:</strong> {{ $recipe->servings ?? 'N/A' }}</p>

                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">View Details</a>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
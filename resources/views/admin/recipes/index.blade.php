@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Recipes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">Create New Recipe</a>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
        @foreach($recipes as $recipe)
            <div style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 10px;">
                <h3>{{ $recipe->recipe_name }}</h3>

                @if($recipe->photo)
                    <img src="{{ asset('storage/' . $recipe->photo) }}" width="100%" alt="Photo of {{ $recipe->recipe_name }}">
                @endif

                <p><strong>Prep Time:</strong> {{ $recipe->prep_time ?? 'N/A' }} minutes</p>
                <p><strong>Servings:</strong> {{ $recipe->servings ?? 'N/A' }}</p>
                <p><strong>Approved:</strong> {{ $recipe->approved ? 'Yes' : 'No' }}</p>

                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @if(!$recipe->approved)
                    <a href="{{ route('recipes.approve', $recipe->id) }}" class="btn btn-success btn-sm">Approve</a>
                @endif
                <a href="{{ route('recipes.image.form', $recipe->id) }}" class="btn btn-secondary btn-sm">Upload Image</a>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $recipes->links() }}
    </div>
</div>
@endsection



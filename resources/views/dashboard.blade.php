@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('recipes.submit') }}" class="btn btn-primary mb-3">Submit a New Recipe</a>

    <h2>Your Recipes</h2>
    @if($userRecipes->isEmpty())
        <p>You haven't submitted any recipes yet.</p>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
            @foreach($userRecipes as $recipe)
                <div style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 10px;">
                    <h3>{{ $recipe->recipe_name }}</h3>
                    <p><strong>Approved:</strong> {{ $recipe->approved ? 'Yes' : 'No' }}</p>
                    <p><strong>Prep Time:</strong> {{ $recipe->prep_time ?? 'N/A' }} minutes</p>
                    <p><strong>Servings:</strong> {{ $recipe->servings ?? 'N/A' }}</p>
                    @if($recipe->approved)
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-info btn-sm">View Details</a>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $userRecipes->links() }}
        </div>
    @endif
</div>
@endsection
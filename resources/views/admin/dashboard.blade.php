@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Pending Recipes</h2>
    @if($pendingRecipes->isEmpty())
        <p>No pending recipes.</p>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 20px;">
            @foreach($pendingRecipes as $recipe)
                <div style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 10px;">
                    <h3>{{ $recipe->recipe_name }}</h3>
                    <p><strong>Instructions:</strong> {{ Str::limit($recipe->instructions, 100) }}</p>
                    <p><strong>Prep Time:</strong> {{ $recipe->prep_time ?? 'N/A' }} minutes</p>
                    <p><strong>Servings:</strong> {{ $recipe->servings ?? 'N/A' }}</p>
                    <p><strong>Submitted by:</strong> {{ $recipe->user ? $recipe->user->first . ' ' . $recipe->user->last : 'Unknown' }}</p>
                    <a href="{{ route('recipes.approve', $recipe->id) }}" class="btn btn-success btn-sm">Approve</a>
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
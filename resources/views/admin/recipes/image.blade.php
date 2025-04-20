@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Upload Image for {{ $recipe->recipe_name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.image', $recipe->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="photo">Upload New Photo:</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*" required>
        </div>

        @if($recipe->photo)
            <div class="form-group mb-3">
                <label>Current Photo:</label><br>
                <img src="{{ asset('storage/' . $recipe->photo) }}" width="200" alt="Current photo of {{ $recipe->recipe_name }}">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Upload Image</button>
    </form>

    <a href="{{ route('recipes.index') }}" class="btn btn-secondary mt-3">Back to Recipes</a>
</div>
@endsection
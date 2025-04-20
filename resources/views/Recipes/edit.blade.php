@extends('layout')

@section('content')
<h1>Edit Recipe</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="recipe_name" placeholder="Recipe Name" 
           value="{{ old('recipe_name') ?? $recipe->recipe_name }}">
    
    <textarea name="instructions" placeholder="Instructions">{{ old('instructions') ?? $recipe->instructions }}</textarea>
    
    <input type="number" name="prep_time" placeholder="Preparation Time" 
           value="{{ old('prep_time') ?? $recipe->prep_time }}">
    
    <input type="number" name="servings" placeholder="Servings" 
           value="{{ old('servings') ?? $recipe->servings }}">

    <h4>Ingredients:</h4>
    @foreach($recipe->ingredients as $i => $ingredient)
        <div>
            <input type="text" name="ingredients[{{ $i }}][ingredient_name]" 
                   value="{{ old("ingredients.$i.ingredient_name") ?? $ingredient->ingredient_name }}">
            <input type="text" name="ingredients[{{ $i }}][quantity]" 
                   value="{{ old("ingredients.$i.quantity") ?? $ingredient->quantity }}">
            <input type="hidden" name="ingredients[{{ $i }}][id]" value="{{ $ingredient->id }}">
        </div>
    @endforeach

    <input type="submit" value="Update Recipe">
</form>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Recipe</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="recipe_name">Recipe Name:</label>
            <input type="text" name="recipe_name" id="recipe_name" class="form-control" 
                   value="{{ old('recipe_name', $recipe->recipe_name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="instructions">Instructions:</label>
            <textarea name="instructions" id="instructions" class="form-control" required>{{ old('instructions', $recipe->instructions) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="prep_time">Preparation Time (minutes):</label>
            <input type="number" name="prep_time" id="prep_time" class="form-control" 
                   value="{{ old('prep_time', $recipe->prep_time) }}">
        </div>

        <div class="form-group mb-3">
            <label for="servings">Servings:</label>
            <input type="number" name="servings" id="servings" class="form-control" 
                   value="{{ old('servings', $recipe->servings) }}">
        </div>

        <h4>Ingredients:</h4>
        <div id="ingredients-wrapper">
            @foreach($recipe->ingredients as $i => $ingredient)
                <div class="ingredient-group">
                    <input type="text" name="ingredients[{{ $i }}][ingredient_name]" 
                           class="form-control" placeholder="Ingredient Name" 
                           value="{{ old("ingredients.$i.ingredient_name", $ingredient->ingredient_name) }}" required>
                    <input type="text" name="ingredients[{{ $i }}][quantity]" 
                           class="form-control" placeholder="Quantity" 
                           value="{{ old("ingredients.$i.quantity", $ingredient->quantity) }}" required>
                    <button type="button" class="remove-ingredient btn btn-danger btn-sm" onclick="removeIngredient(this)">❌</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mt-3" onclick="addIngredient()">Add Another Ingredient</button>

        <button type="submit" class="btn btn-primary mt-3">Update Recipe</button>
    </form>
</div>

<script>
let count = {{ count($recipe->ingredients) }};

function addIngredient() {
    const wrapper = document.getElementById('ingredients-wrapper');
    const group = document.createElement('div');
    group.classList.add('ingredient-group');
    group.innerHTML = `
        <input type="text" name="ingredients[${count}][ingredient_name]" class="form-control" placeholder="Ingredient Name" required>
        <input type="text" name="ingredients[${count}][quantity]" class="form-control" placeholder="Quantity" required>
        <button type="button" class="remove-ingredient btn btn-danger btn-sm" onclick="removeIngredient(this)">❌</button>
    `;
    wrapper.appendChild(group);
    count++;
}

function removeIngredient(button) {
    const group = button.parentElement;
    group.remove();
}
</script>

<style>
    .ingredient-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .ingredient-group input {
        flex: 1;
    }
</style>
@endsection
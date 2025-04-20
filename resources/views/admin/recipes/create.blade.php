@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create a New Recipe</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="recipe_name">Recipe Name:</label>
            <input type="text" name="recipe_name" id="recipe_name" class="form-control" 
                   placeholder="Recipe Name" value="{{ old('recipe_name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="instructions">Instructions:</label>
            <textarea name="instructions" id="instructions" class="form-control" 
                      placeholder="Instructions" required>{{ old('instructions') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="prep_time">Preparation Time (minutes):</label>
            <input type="number" name="prep_time" id="prep_time" class="form-control" 
                   placeholder="Preparation Time" value="{{ old('prep_time') }}">
        </div>

        <div class="form-group mb-3">
            <label for="servings">Servings:</label>
            <input type="number" name="servings" id="servings" class="form-control" 
                   placeholder="Servings" value="{{ old('servings') }}">
        </div>

        <div class="form-group mb-3">
            <label for="photo">Photo:</label>
            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
        </div>

        <h4>Ingredients:</h4>
        <div id="ingredients-wrapper">
            <div class="ingredient-group">
                <input type="text" name="ingredients[0][ingredient_name]" class="form-control" 
                       placeholder="Ingredient Name" required>
                <input type="text" name="ingredients[0][quantity]" class="form-control" 
                       placeholder="Quantity" required>
                <button type="button" class="remove-ingredient btn btn-danger btn-sm" onclick="removeIngredient(this)">❌</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mt-3" onclick="addIngredient()">Add Another Ingredient</button>

        <button type="submit" class="btn btn-primary mt-3">Create Recipe</button>
    </form>
</div>

<script>
let count = 1;

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

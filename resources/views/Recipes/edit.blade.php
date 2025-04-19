<form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="recipe_name" value="{{ $recipe->recipe_name }}" required>
    <textarea name="instructions" required>{{ $recipe->instructions }}</textarea>
    <input type="number" name="prep_time" value="{{ $recipe->prep_time }}">
    <input type="number" name="servings" value="{{ $recipe->servings }}">

    <p>Current Photo:</p>
    @if($recipe->photo)
        <img src="{{ asset('storage/' . $recipe->photo) }}" width="150">
    @endif
    <input type="file" name="photo" accept="image/*">

    <h4>Ingredients:</h4>
    @foreach($recipe->ingredients as $i => $ingredient)
        <div class="ingredient-group">
            <input type="text" name="ingredients[{{ $i }}][ingredient_name]" value="{{ $ingredient->ingredient_name }}" required>
            <input type="text" name="ingredients[{{ $i }}][quantity]" value="{{ $ingredient->quantity }}" required>
            <input type="hidden" name="ingredients[{{ $i }}][id]" value="{{ $ingredient->id }}">
            <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">❌</button>
            </form>
        </div>
    @endforeach

    <button type="submit">Update Recipe</button>
</form>

<form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    @if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <input type="text" name="recipe_name" placeholder="Recipe Name" required>
    <textarea name="instructions" placeholder="Instructions" required></textarea>
    <input type="number" name="prep_time" placeholder="Preparation Time">
    <input type="number" name="servings" placeholder="Servings">
    <input type="file" name="photo" accept="image/*">

    <h4>Ingredients:</h4>

    <div id="ingredients-wrapper">
        <div class="ingredient-group">
            <input type="text" name="ingredients[0][ingredient_name]" placeholder="Ingredient Name" required>
            <input type="text" name="ingredients[0][quantity]" placeholder="Quantity" required>
            <button type="button" class="remove-ingredient" onclick="removeIngredient(this)">❌</button>
        </div>
    </div>

    <button type="button" onclick="addIngredient()">Add Another Ingredient</button>

    <button type="submit">Submit</button>
</form>

<script>
let count = 1;

function addIngredient() {
    const wrapper = document.getElementById('ingredients-wrapper');
    const group = document.createElement('div');
    group.classList.add('ingredient-group');
    group.innerHTML = `
        <input type="text" name="ingredients[${count}][ingredient_name]" placeholder="Ingredient Name" required>
        <input type="text" name="ingredients[${count}][quantity]" placeholder="Quantity" required>
        <button type="button" class="remove-ingredient" onclick="removeIngredient(this)">❌</button>
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
        margin-bottom: 10px;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="recipe_name">Recipe Name:</label>
                            <input type="text" name="recipe_name" id="recipe_name" class="w-full border-gray-300 rounded" required>
                            @error('recipe_name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="instructions">Instruction:</label>
                            <textarea name="instructions" id="instructions" class="w-full border-gray-300 rounded" required></textarea>
                            @error('instructions')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prep_time">Prepare Time: (mins)</label>
                            <input type="number" name="prep_time" id="prep_time" class="w-full border-gray-300 rounded" required>
                            @error('prep_time')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="servings">Servings:</label>
                            <input type="number" name="servings" id="servings" class="w-full border-gray-300 rounded" required>
                            @error('servings')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="photo">Photo: (optional)</label>
                            <input type="file" name="photo" id="photo" class="w-full border-gray-300 rounded">
                            @error('photo')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4" id="ingredients-container">
                            <label>Ingredient:</label>
                            <div class="ingredient-row flex space-x-4 mb-2">
                                <input type="text" name="ingredients[0][name]" placeholder="Ingredient Name" class="w-1/2 border-gray-300 rounded" required>
                                <input type="text" name="ingredients[0][quantity]" placeholder="Quantity" class="w-1/2 border-gray-300 rounded" required>
                            </div>
                        </div>

                        <button type="button" onclick="addIngredientRow()" class="mb-4 bg-gray-500 text-white px-4 py-2 rounded">
                            Add another ingredient
                        </button>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Submit Recipe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let ingredientIndex = 1;

        function addIngredientRow() {
            const container = document.getElementById('ingredients-container');
            const newRow = document.createElement('div');
            newRow.className = 'ingredient-row flex space-x-4 mb-2';
            newRow.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Ingredient Name" class="w-1/2 border-gray-300 rounded" required>
                <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantity" class="w-1/2 border-gray-300 rounded" required>
            `;
            container.appendChild(newRow);
            ingredientIndex++;
        }
    </script>
</x-app-layout>
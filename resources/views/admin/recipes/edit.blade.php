<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.recipes.update', $recipe) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="recipe_name">Recipe Name: </label>
                            <input type="text" name="recipe_name" id="recipe_name" value="{{ $recipe->recipe_name }}" class="w-full border-gray-300 rounded" required>
                            @error('recipe_name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="instructions">Instruction:</label>
                            <textarea name="instructions" id="instructions" class="w-full border-gray-300 rounded" required>{{ $recipe->instructions }}</textarea>
                            @error('instructions')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prep_time">Prepare Time: </label>
                            <input type="number" name="prep_time" id="prep_time" value="{{ $recipe->prep_time }}" class="w-full border-gray-300 rounded" required>
                            @error('prep_time')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="servings">Servings: </label>
                            <input type="number" name="servings" id="servings" value="{{ $recipe->servings }}" class="w-full border-gray-300 rounded" required>
                            @error('servings')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="photo">Photo: (optional)</label>
                            <input type="file" name="photo" id="photo" class="w-full border-gray-300 rounded">
                            @if ($recipe->photo)
                                <img src="{{ asset('storage/' . $recipe->photo) }}" alt="當前照片" class="my-2 max-w-xs">
                            @endif
                            @error('photo')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4" id="ingredients-container">
                            <label>Ingredient:</label>
                            @foreach ($recipe->ingredients as $index => $ingredient)
                                <div class="ingredient-row flex space-x-4 mb-2">
                                    <input type="text" name="ingredients[{{ $index }}][name]" value="{{ $ingredient->ingredient_name }}" placeholder="食材名稱" class="w-1/2 border-gray-300 rounded" required>
                                    <input type="text" name="ingredients[{{ $index }}][quantity]" value="{{ $ingredient->quantity }}" placeholder="數量" class="w-1/2 border-gray-300 rounded" required>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" onclick="addIngredientRow()" class="mb-4 bg-gray-500 text-white px-4 py-2 rounded">
                            Add another ingredient
                        </button>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Update Recipe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let ingredientIndex = {{ $recipe->ingredients->count() }};

        function addIngredientRow() {
            const container = document.getElementById('ingredients-container');
            const newRow = document.createElement('div');
            newRow.className = 'ingredient-row flex space-x-4 mb-2';
            newRow.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="食材名稱" class="w-1/2 border-gray-300 rounded" required>
                <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="數量" class="w-1/2 border-gray-300 rounded" required>
            `;
            container.appendChild(newRow);
            ingredientIndex++;
        }
    </script>
</x-app-layout>
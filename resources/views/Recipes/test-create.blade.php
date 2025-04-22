<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <label for="recipe_name" class="block text-sm font-medium text-gray-700">Recipe Name</label>
                            <input type="text" name="recipe_name" id="recipe_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            @error('recipe_name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="instructions"
                                class="block text-sm font-medium text-gray-700">Instructions</label>
                            <textarea name="instructions" id="instructions" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required></textarea>
                            @error('instructions')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="prep_time" class="block text-sm font-medium text-gray-700">Prep Time
                                    (minutes)</label>
                                <input type="number" name="prep_time" id="prep_time" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                @error('prep_time')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="servings" class="block text-sm font-medium text-gray-700">Number of
                                    Servings</label>
                                <input type="number" name="servings" id="servings" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                @error('servings')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Recipe Photo
                                (optional)</label>
                            <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100">
                            @error('photo')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ingredients</label>
                            <div id="ingredients-container" class="space-y-3">
                                <div class="ingredient-row flex space-x-4">
                                    <input type="text" name="ingredients[0][name]" placeholder="Ingredient Name"
                                        class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                    <input type="text" name="ingredients[0][quantity]" placeholder="Quantity"
                                        class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                </div>
                            </div>
                            <button type="button" onclick="addIngredientRow()"
                                class="mt-3 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add Another Ingredient
                            </button>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('recipes.my') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-blue rounded-md font-semibold text-xs text-blue uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Create Recipe
                            </button>
                        </div>
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
            newRow.className = 'ingredient-row flex space-x-4';
            newRow.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Ingredient Name" 
                    class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    required>
                <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantity" 
                    class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    required>
                <button type="button" onclick="removeIngredientRow(this)" class="text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            container.appendChild(newRow);
            ingredientIndex++;
        }

        function removeIngredientRow(button) {
            const row = button.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</x-app-layout>
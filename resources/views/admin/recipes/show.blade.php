<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recipe Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">{{ $recipe->recipe_name }}</h3>
                    <p>User:{{ $recipe->user->name }} (ID: {{ $recipe->user_id }})</p>
                    <p>Prepare time: {{ $recipe->prep_time }} minutes</p>
                    <p>Servings: {{ $recipe->servings }} people</p>
                    <p>Instruction: {{ $recipe->instructions }}</p>

                    @if ($recipe->photo)
                        <img src="{{ asset('storage/' . $recipe->photo) }}" alt="recipe photo" class="my-4 max-w-xs">
                    @endif

                    <h4 class="mt-4 font-semibold">Ingredient</h4>
                    <ul>
                        @foreach ($recipe->ingredients as $ingredient)
                            <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
                        @endforeach
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('admin.recipes.edit', $recipe) }}" class="text-yellow-500">edit</a>
                        <a href="{{ route('recipes.show', $recipe) }}" class="text-blue-500 ml-3" target="_blank">view
                            on frontend</a>
                        <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"
                                onclick="return confirm('confirm delete?')">delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
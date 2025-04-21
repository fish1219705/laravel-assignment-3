<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Recipe Hub</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Use CDN Tailwind instead of Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white shadow py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Recipe Hub</h1>

                <div>
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                                <a href="{{ route('recipes.my') }}" class="text-gray-700 hover:text-gray-900">My Recipes</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 ml-4">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <div class="container mx-auto px-4 py-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Discover Delicious Recipes</h2>
                <p class="text-gray-600">Browse through our collection of tasty recipes.</p>
            </div>

            <div>
                @if(isset($recipes) && $recipes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recipes as $recipe)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="h-48 bg-gray-200">
                                    @if($recipe->photo)
                                        <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->recipe_name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $recipe->recipe_name }}</h3>
                                    <p class="text-gray-600 mt-1">By {{ $recipe->user->name }}</p>

                                    <div class="flex items-center mt-2 text-gray-600">
                                        <span>{{ $recipe->prep_time }} minutes</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $recipe->servings }} servings</span>
                                    </div>

                                    <div class="mt-4 flex space-x-3">
                                        <button class="text-blue-500 hover:underline"
                                            onclick="toggleDetails({{ $recipe->id }})">Quick View</button>
                                        <a href="{{ route('recipes.show', $recipe) }}" class="text-green-500 hover:underline">
                                            View Full Recipe
                                        </a>
                                    </div>

                                    <div id="details-{{ $recipe->id }}" class="hidden mt-4 border-t pt-4">
                                        <h4 class="font-semibold mb-2">Ingredients:</h4>
                                        <ul class="list-disc pl-5 mb-4">
                                            @foreach($recipe->ingredients as $ingredient)
                                                <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
                                            @endforeach
                                        </ul>

                                        <h4 class="font-semibold mb-2">Instructions:</h4>
                                        <div class="text-gray-700 whitespace-pre-line">{{ $recipe->instructions }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                        <p class="text-xl text-gray-600">No recipes found.</p>
                        @auth
                            <a href="{{ route('recipes.create') }}"
                                class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Create a
                                Recipe</a>
                        @else
                            <p class="mt-4 text-gray-600">Login to create your own recipes!</p>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(recipeId) {
            const detailsElement = document.getElementById(`details-${recipeId}`);
            if (detailsElement.classList.contains('hidden')) {
                detailsElement.classList.remove('hidden');
            } else {
                detailsElement.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
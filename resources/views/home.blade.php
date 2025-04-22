<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Hub</title>
    <!-- Use CDN Tailwind instead of Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Recipe Hub</h1>
        
        <div class="mb-4">
            <a href="{{ route('login') }}" class="text-blue-500 mr-4">Login</a>
            <a href="{{ route('register') }}" class="text-blue-500">Register</a>
        </div>
        
        <h2 class="text-2xl font-semibold mb-4">Discover Delicious Recipes</h2>
        
        @if($recipes->isEmpty())
            <p class="bg-white p-4 rounded shadow">No recipes found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($recipes as $recipe)
                    <div class="bg-white rounded shadow p-4">
                        <h3 class="text-xl font-semibold">{{ $recipe->recipe_name }}</h3>
                        <p class="text-gray-600">By {{ $recipe->user->name }}</p>
                        <p class="mt-2">Prep Time: {{ $recipe->prep_time }} minutes</p>
                        <p>Servings: {{ $recipe->servings }}</p>
                        
                        <button onclick="toggleDetails({{ $recipe->id }})" class="text-blue-500 mt-2">
                            View Details
                        </button>
                        
                        <div id="details-{{ $recipe->id }}" class="hidden mt-4">
                            <h4 class="font-semibold">Ingredients:</h4>
                            <ul class="list-disc ml-4">
                                @foreach($recipe->ingredients as $ingredient)
                                    <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
                                @endforeach
                            </ul>
                            
                            <h4 class="font-semibold mt-2">Instructions:</h4>
                            <p class="whitespace-pre-line">{{ $recipe->instructions }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
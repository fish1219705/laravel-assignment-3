<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $recipe->recipe_name }} - Recipe Hub</title>

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
                            <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Home</a>
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
            <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-auto">
                @if($recipe->photo)
                    <div class="h-64 bg-gray-200">
                        <img src="{{ asset('storage/' . $recipe->photo) }}" alt="{{ $recipe->recipe_name }}"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $recipe->recipe_name }}</h1>
                    <p class="text-gray-600 mb-4">By {{ $recipe->user->name }}</p>

                    <div class="flex items-center mb-6 text-gray-600">
                        <span class="mr-4"><strong>Prep Time:</strong> {{ $recipe->prep_time }} minutes</span>
                        <span><strong>Servings:</strong> {{ $recipe->servings }}</span>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Ingredients</h2>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($recipe->ingredients as $ingredient)
                                <li>{{ $ingredient->ingredient_name }} - {{ $ingredient->quantity }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Instructions</h2>
                        <div class="text-gray-700 whitespace-pre-line">{{ $recipe->instructions }}</div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ url('/') }}" class="text-blue-500 hover:underline">&larr; Back to all recipes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
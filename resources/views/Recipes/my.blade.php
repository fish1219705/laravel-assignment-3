<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('recipes.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                        Add Recipe
                    </a>

                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($recipes->isEmpty())
                        <p>You haven't add any recipe yet. Contribute one now!</p>
                    @else
                        <table class="w-full mt-4">
                            <thead>
                                <tr>
                                    <th>Recipe Name</th>
                                    <th>Prepare Time</th>
                                    <th>Servings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recipes as $recipe)
                                    <tr>
                                        <td>{{ $recipe->recipe_name }}</td>
                                        <td>{{ $recipe->prep_time }} minutes</td>
                                        <td>{{ $recipe->servings }} people</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
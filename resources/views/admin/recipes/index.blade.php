<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Recipes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full mt-4">
                        <thead>
                            <tr>
                                <th>Recipe Name</th>
                                <th>User</th>
                                <th>Prepare Time</th>
                                <th>Servings</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $recipe)
                                <tr>
                                    <td>{{ $recipe->recipe_name }}</td>
                                    <td>{{ $recipe->user->name }} (ID: {{ $recipe->user_id }})</td>
                                    <td>{{ $recipe->prep_time }} minutes</td>
                                    <td>{{ $recipe->servings }} people</td>
                                    <td>
                                        <a href="{{ route('admin.recipes.show', $recipe) }}" class="text-blue-500">view</a>
                                        <a href="{{ route('admin.recipes.edit', $recipe) }}"
                                            class="text-yellow-500">edit</a>
                                        <a href="{{ route('recipes.show', $recipe) }}" class="text-green-500"
                                            target="_blank">frontend</a>
                                        <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500"
                                                onclick="return confirm('Confirm Delete?')">delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
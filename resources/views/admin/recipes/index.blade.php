<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Recipes
            </h2>
            <a href="{{ route('admin.recipes.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Recipe
            </a>
        </div>
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

                    <table class="min-w-full bg-white border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Recipe Name</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">User</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Prepare Time</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Servings</th>
                                <th class="py-2 px-4 border-b border-gray-300 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $recipe)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $recipe->recipe_name }}</td>
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $recipe->user->name }} (ID:
                                        {{ $recipe->user_id }})</td>
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $recipe->prep_time }} minutes</td>
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $recipe->servings }} people</td>
                                    <td class="py-2 px-4 border-b border-gray-300">
                                        <a href="{{ route('admin.recipes.show', $recipe) }}"
                                            class="text-blue-500 hover:underline mr-2">View</a>
                                        <a href="{{ route('admin.recipes.edit', $recipe) }}"
                                            class="text-yellow-500 hover:underline mr-2">Edit</a>
                                        <a href="{{ route('recipes.show', $recipe) }}"
                                            class="text-green-500 hover:underline mr-2" target="_blank">Frontend</a>
                                        <form action="{{ route('admin.recipes.destroy', $recipe) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline"
                                                onclick="return confirm('Are you sure you want to delete this recipe?')">Delete</button>
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
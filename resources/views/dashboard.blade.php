<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <br><br>

                    <a href="{{ route('recipes.my') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                        See my recipes
                    </a>

                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.recipes.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">
                            Manage recipes
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="mt-4 inline-block bg-purple-500 text-white px-4 py-2 rounded">
                            Manage Users
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

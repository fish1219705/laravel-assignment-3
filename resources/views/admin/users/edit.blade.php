<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name">Username: </label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded" required>
                            @error('name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email">Email Address: </label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded" required>
                            @error('email')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password">Password: (if blank then keep original)</label>
                            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded">
                            @error('password')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation">Confirm Password: </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded">
                        </div>

                        <div class="mb-4">
                            <label for="is_admin">If Admin</label>
                            <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
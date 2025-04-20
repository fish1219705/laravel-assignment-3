@extends('layouts.app')

@section('content')
<section class="container">
    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="first">First Name:</label>
            <input type="text" name="first" id="first" class="form-control" value="{{ old('first', $user->first) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="last">Last Name:</label>
            <input type="text" name="last" id="last" class="form-control" value="{{ old('last', $user->last) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password (leave blank to keep current password):</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
        </div>

        <div class="form-group mb-3">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Back to User List</a>
</section>
@endsection

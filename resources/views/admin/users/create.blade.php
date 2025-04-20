@extends('layouts.app')

@section('content')
<section class="container">
    <h2>Add User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}" novalidate>
        @csrf

        <div class="form-group mb-3">
            <label for="first">First Name:</label>
            <input type="text" name="first" id="first" class="form-control" value="{{ old('first') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="last">Last Name:</label>
            <input type="text" name="last" id="last" class="form-control" value="{{ old('last') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">← Back to User List</a>
</section>
@endsection

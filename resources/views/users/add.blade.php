@extends ('layout.console')

@section ('content')

<section>
    <h2>Add User</h2>

    <form method="post" action="{{ route('console.users.add') }}" novalidate>
        @csrf

        <div>
            <label for="first">First Name:</label>
            <input type="text" name="first" id="first" value="{{ old('first') }}" required>
            
            @if ($errors->first('first'))
                <br>
                <span class="error">{{ $errors->first('first') }}</span>
            @endif
        </div>

        <div>
            <label for="last">Last Name:</label>
            <input type="text" name="last" id="last" value="{{ old('last') }}" required>

            @if ($errors->first('last'))
                <br>
                <span class="error">{{ $errors->first('last') }}</span>
            @endif
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>

            @if ($errors->first('email'))
                <br>
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            @if ($errors->first('password'))
                <br>
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button type="submit">Add User</button>
    </form>

    <a href="{{ route('console.users.list') }}">Back to User List</a>
</section>

@endsection

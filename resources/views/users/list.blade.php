@extends ('layout.console')

@section ('content')

<section>

    <h2>Manage Users</h2>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td>{{$user->first}} {{$user->last}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->format('M j, Y')}}</td>
                <td><a href="{{ route('console.users.edit.form', ['user' => $user->id]) }}">Edit</a></td>
                <td><a href="{{ route('console.users.delete', ['user' => $user->id]) }}">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="{{ route('console.users.add.form') }}">New User</a>

</section>

@endsection

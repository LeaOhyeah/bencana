<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>User Archive</h1>
    <h2>
        <a href="{{ route('dashboard') }}">Back
        </a>
    </h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Verified Email At</th>
                {{-- <th>Password</th> --}}
                <th>Role</th>
                <th>Photo Profile</th>
                <th>Identity Card</th>
                <th>Verified</th>
                <th>Blocked</th>
                <th>Remember Token</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th>Post ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    {{-- <td>{{ $user->password }}</td> --}}
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->photo_profile }}</td>
                    <td>{{ $user->identity_card }}</td>
                    <td>{{ $user->is_verified }}</td>
                    <td>{{ $user->is_blocked }}</td>
                    <td>{{ $user->remember_token }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->deleted_at }}</td>
                    <td>{{ $user->post_id }}</td>
                    <td>
                        <form method="post" action="{{ route('user.restore') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit">
                                <h4>Restore User</h4>
                            </button>
                        </form><br>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

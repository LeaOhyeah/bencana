<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Post Archive</h1>
    <h2>
        <a href="{{ route('dashboard') }}">Back
        </a>
    </h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Disaster ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th>Created by</th>
                <th>Edited by</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->code }}</td>
                    <td>{{ $post->disaster_id }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->photo }}</td>
                    <td>{{ $post->lat }}</td>
                    <td>{{ $post->long }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>{{ $post->deleted_at }}</td>
                    <td>{{ $post->created_by }}</td>
                    <td>{{ $post->edited_by }}</td>
                    <td>
                        <form method="post" action="{{ route('post.restore') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $post->id }}">
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

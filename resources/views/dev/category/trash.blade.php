<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Category Archive</h1>
    <h2>
        <a href="{{ route('dashboard') }}">Back
        </a>
    </h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created By</th>
                <th>Edited By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_by }}</td>
                    <td>{{ $category->edited_by }}</td>
                    <td>
                        <form method="post" action="{{ route('category.restore') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <button type="submit">
                                <h4>Restore category</h4>
                            </button>
                        </form><br>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

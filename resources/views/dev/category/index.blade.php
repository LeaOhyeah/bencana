<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Category</h1>
    <h2>
        <a href="{{ route('category.create') }}">Create
        </a>
    </h2>
    <h2>
        <a href="{{ route('dashboard') }}">Back
        </a>
    </h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Deleted At</th>
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
                    <td>{{ $category->deleted_at }}</td>
                    <td>{{ $category->created_by }}</td>
                    <td>{{ $category->edited_by }}</td>
                    <td><a href="{{ route('category.edit', $category->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

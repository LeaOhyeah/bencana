<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Req</h1>
    <h2>
        <a href="{{ route('req.create') }}">Create
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
                <th>Code</th>
                <th>Post ID</th>
                <th>Category ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Is Completed</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th>Created By</th>
                <th>Edited By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reqs as $req)
                <tr>
                    <td>{{ $req->id }}</td>
                    <td>{{ $req->code }}</td>
                    <td>{{ $req->post_id }}</td>
                    <td>{{ $req->category_id }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->description }}</td>
                    <td>{{ $req->quantity }}</td>
                    <td>{{ $req->unit }}</td>
                    <td>{{ $req->is_completed }}</td>
                    <td>{{ $req->created_at }}</td>
                    <td>{{ $req->updated_at }}</td>
                    <td>{{ $req->deleted_at }}</td>
                    <td>{{ $req->created_by }}</td>
                    <td>{{ $req->edited_by }}</td>
                    <td><a href="{{ route('req.edit', $req->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

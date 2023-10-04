<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Aid Archive</h1>
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
                <th>Req ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Is Over</th>
                <th>Quantity</th>
                <th>nit</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Deleted At</th>
                <th>Created By</th>
                <th>Edited By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aids as $aid)
                <tr>
                    <td>{{ $aid->id }}</td>
                    <td>{{ $aid->code }}</td>
                    <td>{{ $aid->post_id }}</td>
                    <td>{{ $aid->category_id }}</td>
                    <td>{{ $aid->req_id }}</td>
                    <td>{{ $aid->name }}</td>
                    <td>{{ $aid->description }}</td>
                    <td>{{ $aid->is_over ? 'Yes' : 'No' }}</td>
                    <td>{{ $aid->quantity }}</td>
                    <td>{{ $aid->unit }}</td>
                    <td>{{ $aid->created_at }}</td>
                    <td>{{ $aid->updated_at }}</td>
                    <td>{{ $aid->deleted_at }}</td>
                    <td>{{ $aid->created_by }}</td>
                    <td>{{ $aid->edited_by }}</td>
                    <td>
                        <form method="post" action="{{ route('aid.restore') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $aid->id }}">
                            <button type="submit">
                                <h4>Restore Aid</h4>
                            </button>
                        </form><br>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

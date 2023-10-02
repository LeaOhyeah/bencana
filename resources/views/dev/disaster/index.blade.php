<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>Disaster</h1>
    <h2>
        <a href="{{ route('disaster.create') }}">Create
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
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Close Date</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Deleted At</th>
                <th>Created By</th>
                <th>Edited By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disasters as $disaster)
                <tr>
                    <td>{{ $disaster->id }}</td>
                    <td>{{ $disaster->code }}</td>
                    <td>{{ $disaster->name }}</td>
                    <td>{{ $disaster->description }}</td>
                    <td>{{ $disaster->start_date }}</td>
                    <td>{{ $disaster->end_date }}</td>
                    <td>{{ $disaster->closed_date }}</td>
                    <td>{{ $disaster->lat }}</td>
                    <td>{{ $disaster->long }}</td>
                    <td>{{ $disaster->deleted_at }}</td>
                    <td>{{ $disaster->created_by }}</td>
                    <td>{{ $disaster->edited_by }}</td>
                    <td><a href="{{ route('disaster.edit', $disaster->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

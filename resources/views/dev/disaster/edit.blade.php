<!DOCTYPE html>
<html>

<head>
    <title>Edit Disaster</title>
</head>

<body>
    <h1>Edit Disaster</h1>

    <form method="post" action="{{ route('disaster.destroy', $disaster->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Disaster</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('disaster.update', $disaster->id) }}">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->code }}" type="text" id="code" name="code" required><br>
        <br>


        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $disaster->description }}</textarea><br>
        <br>

        <label for="start_date">Start Date:</label>
        @error('start_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->start_date }}" type="date" id="start_date" name="start_date" required><br>
        <br>

        <label for="end_date">End Date:</label>
        @error('end_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->end_date }}" type="date" id="end_date" name="end_date"><br>
        <br>

        <label for="closed_date">Closed Date:</label>
        @error('closed_date')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->closed_date }}" type="date" id="closed_date" name="closed_date"><br>
        <br>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->lat }}" type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input value="{{ $disaster->long }}" type="text" id="long" name="long" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

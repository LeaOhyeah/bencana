<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
</head>

<body>
    <h1>Create Post</h1>

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input type="text" id="code" name="code" required><br>
        <br>

        <label for="disaster_id">Disaster ID:</label>
        @error('disaster_id')
            {{ $message }}
        @enderror
        <select name="disaster_id" id="disaster_id">
            <option>Select Disaster</option>
            @foreach ($disasters as $disaster)
                <option value="{{ $disaster->id }}">{{ $disaster->name }}</option>
            @endforeach
        </select><br><br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10"></textarea><br>
        <br>

        <label for="photo">Photo:</label>
        @error('photo')
            {{ $message }}
        @enderror
        <input type="file" id="photo" name="photo"><br>
        <br>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input type="text" id="long" name="long" required><br>
        <br>

        <button type="submit">
            <h4>Save Data</h4>
        </button>
    </form>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Create Category</title>
    @vite('public/css/style.css')
</head>

<body>
    <h1 class="">Create Category</h1>

    <form method="POST" action="{{ route('category.store') }}">
        @csrf

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input type="text" id="name" name="name" required><br>
        <br>

        <button type="submit">
            <h4>Save Data</h4>
        </button>
    </form>
</body>

</html>

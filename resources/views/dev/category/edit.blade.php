<!DOCTYPE html>
<html>

<head>
    <title>Edit Category</title>
</head>

<body>
    <h1>Edit Category</h1>

    <form method="post" action="{{ route('category.destroy', $category->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Category</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('category.update', $category->id) }}">
        @method('put')
        @csrf
        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $category->name }}" type="text" id="name" name="name" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

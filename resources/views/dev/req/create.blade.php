<!DOCTYPE html>
<html>

<head>
    <title>Create Req</title>
</head>

<body>
    <h1>Create Req</h1>

    <form method="POST" action="{{ route('req.store') }}">
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input type="text" id="code" name="code" required><br>
        <br>

        <label for="post_id">Post ID:</label>
        @error('post_id')
            {{ $message }}
        @enderror
        <select name="post_id" id="post_id">
            <option>Select Post</option>
            @foreach ($posts as $post)
                <option value="{{ $post->id }}">{{ $post->name }}</option>
            @endforeach
        </select><br><br>

        <label for="category_id">Category ID:</label>
        @error('category_id')
            {{ $message }}
        @enderror
        <select name="category_id" id="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
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

        <label for="quantity">Quantity:</label>
        @error('quantity')
            {{ $message }}
        @enderror
        <input type="number" id="quantity" name="quantity" required><br>
        <br>

        <label for="unit">Unit:</label>
        @error('unit')
            {{ $message }}
        @enderror
        <input type="text" id="unit" name="unit" required><br>
        <br>

        <button type="submit">
            <h4>Save Data</h4>
        </button>
    </form>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Req</title>
</head>

<body>
    <h1>Edit Req</h1>

    <form method="post" action="{{ route('req.destroy', $req->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Req</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('req.update', $req->id) }}">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $req->code }}" type="text" id="code" name="code" required><br>
        <br>

        <label for="post_id">Post ID:</label>
        @error('post_id')
            {{ $message }}
        @enderror
        <select name="post_id" id="post_id">
            <option>Select Post</option>
            @foreach ($posts as $post)
                @if ($req->post_id == $post->id)
                    <option value="{{ $post->id }}" selected>{{ $post->name }}</option>
                @else
                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="category_id">Post ID:</label>
        @error('category_id')
            {{ $message }}
        @enderror
        <select name="category_id" id="category_id">
            <option>Select Post</option>
            @foreach ($categories as $category)
                @if ($req->category_id == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $req->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $req->description }}</textarea><br>
        <br>

        <label for="quantity">Quantity:</label>
        @error('quantity')
            {{ $message }}
        @enderror
        <input value="{{ $req->quantity }}" type="number" id="quantity" name="quantity" required><br>
        <br>

        <label for="unit">Unit:</label>
        @error('unit')
            {{ $message }}
        @enderror
        <input value="{{ $req->unit }}" type="text" id="unit" name="unit" required><br>
        <br>

        <label for="is_completed">Completed:</label>
        @error('is_completed')
            {{ $message }}
        @enderror
        <input value="{{ $req->is_completed }}" type="checkbox" id="is_completed" name="is_completed"
            {{ $req->is_completed ? 'checked' : '' }}><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

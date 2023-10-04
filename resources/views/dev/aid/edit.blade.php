<!DOCTYPE html>
<html>

<head>
    <title>Edit Aid</title>
</head>

<body>
    <h1>Edit Aid</h1>

    <form method="post" action="{{ route('aid.destroy', $aid->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Aid</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('aid.update', $aid->id) }}">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $aid->code }}" type="text" id="code" name="code" required><br>
        <br>

        <label for="post_id">Post ID:</label>
        @error('post_id')
            {{ $message }}
        @enderror
        <select name="post_id" id="post_id">
            <option>Select Post</option>
            @foreach ($posts as $post)
                @if ($aid->post_id == $post->id)
                    <option value="{{ $post->id }}" selected>{{ $post->name }}</option>
                @else
                    <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="category_id">Category ID:</label>
        @error('category_id')
            {{ $message }}
        @enderror
        <select name="category_id" id="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                @if ($aid->category_id == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="req_id">Req ID:</label>
        @error('req_id')
            {{ $message }}
        @enderror
        <select name="req_id" id="req_id">
            <option>Select Req</option>
            @foreach ($categories as $category)
                @if ($aid->req_id == $category->id)
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
        <input value="{{ $aid->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $aid->description }}</textarea><br>
        <br>

        <label for="is_over">Is Over:</label>
        @error('is_over')
            {{ $message }}
        @enderror
        <input value="{{ $aid->is_over }}" type="checkbox" id="is_over" name="is_over"
            {{ $aid->is_over ? 'checked' : '' }}><br>
        <br>

        <label for="quantity">Quantity:</label>
        @error('quantity')
            {{ $message }}
        @enderror
        <input value="{{ $aid->quantity }}" type="number" id="quantity" name="quantity" required><br>
        <br>

        <label for="unit">Unit:</label>
        @error('unit')
            {{ $message }}
        @enderror
        <input value="{{ $aid->unit }}" type="text" id="unit" name="unit" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

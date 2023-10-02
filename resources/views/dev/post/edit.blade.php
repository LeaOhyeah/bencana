<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
</head>

<body>
    <h1>Edit Post</h1>

    <form method="post" action="{{ route('post.destroy', $post->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete Post</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <label for="code">Code:</label>
        @error('code')
            {{ $message }}
        @enderror
        <input value="{{ $post->code }}" type="text" id="code" name="code" required><br>
        <br>

        <label for="disaster_id">Disaster ID:</label>
        @error('disaster_id')
            {{ $message }}
        @enderror
        <select name="disaster_id" id="disaster_id">
            <option>Select Disaster</option>
            @foreach ($disasters as $disaster)
                @if ($post->disaster_id == $disaster->id)
                    <option value="{{ $disaster->id }}" selected>{{ $disaster->name }}</option>
                @else
                    <option value="{{ $disaster->id }}">{{ $disaster->name }}</option>
                @endif
            @endforeach
        </select><br><br>

        <label for="name">Name:</label>
        @error('name')
            {{ $message }}
        @enderror
        <input value="{{ $post->name }}" type="text" id="name" name="name" required><br>
        <br>

        <label for="description">Description</label>
        @error('description')
            {{ $message }}
        @enderror
        <textarea name="description" id="description" cols="30" rows="10">{{ $post->description }}</textarea><br>
        <br>

        <label for="photo">Photo:</label>
        @error('photo')
            {{ $message }}
        @enderror
        <input type="file" id="photo" name="photo"><br>
        <input value="{{$post->photo}}" type="hidden" name="old_photo"><br>
        <img src="{{ asset('storage/' . $post->photo) }}" alt="" style="width: 300px;"><br><br>

        <label for="lat">Lat:</label>
        @error('lat')
            {{ $message }}
        @enderror
        <input value="{{ $post->lat }}" type="text" id="lat" name="lat" required><br>
        <br>

        <label for="long">Long:</label>
        @error('long')
            {{ $message }}
        @enderror
        <input value="{{ $post->long }}" type="text" id="long" name="long" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

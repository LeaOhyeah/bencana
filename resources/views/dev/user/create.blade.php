<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<body>
    <h1>Create User</h1>

    <br>
    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="full_name">Full Name:</label>
        @error('full_name')
            {{ $message }}
        @enderror
        <input type="text" id="full_name" name="full_name"><br><br>

        <label for="email">Email:</label>
        @error('email')
            {{ $message }}
        @enderror
        <input type="email" id="email" name="email"><br><br>

        <label for="password">Password:</label>
        @error('password')
            {{ $message }}
        @enderror
        <input type="password" id="password" name="password"><br><br>

        <label for="role">Role:</label>
        @error('role')
            {{ $message }}
        @enderror
        <input type="number" id="role" name="role"><br><br>

        <label for="photo_profile">Photo Profile:</label>
        @error('photo_profile')
            {{ $message }}
        @enderror
        <input type="file" id="photo_profile" name="photo_profile"><br><br>

        <label for="identity_card">Identity Card:</label>
        @error('identity_card')
            {{ $message }}
        @enderror
        <input type="file" id="identity_card" name="identity_card"><br><br>

        <label for="is_verified">Verified:</label>
        @error('is_verified')
            {{ $message }}
        @enderror
        <input type="checkbox" id="is_verified" name="is_verified" value="1"><br><br>

        <label for="is_blocked">Blocked:</label>
        @error('is_blocked')
            {{ $message }}
        @enderror
        <input type="checkbox" id="is_blocked" name="is_blocked" value="1"><br><br>

        <label for="remember_token">Remember Token:</label>
        @error('remember_token')
            {{ $message }}
        @enderror
        <input type="text" id="remember_token" name="remember_token"><br><br>

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

        <button type="submit">
            <h4>Save Data</h4>
        </button>

    </form>
</body>

</html>

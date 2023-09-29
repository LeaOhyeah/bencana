<!DOCTYPE html>
<html>

<head>
    <title>Form User</title>
</head>

<body>
    <h1>Form User</h1>
    <form method="POST" action="{{ route('user.update', $user->id) }}">
        @csrf
        @method('PUT')
        <label for="full_name">Full Name:</label>
        <input value="{{ $user->full_name }}" type="text" id="full_name" name="full_name" required><br>
        <br>


        <label for="email">Email:</label>
        <input value="{{ $user->email }}" type="email" id="email" name="email" required><br>
        <br>

        <label for="password">Password:</label>
        <input value="{{ $user->password }}" type="password" id="password" name="password" required><br>
        <br>

        <label for="role">Role:</label>
        <input value="{{ $user->role }}" type="number" id="role" name="role" required><br>
        <br>

        <label for="photo_profile">Photo Profile:</label>
        <input value="" type="file" id="photo_profile" name="photo_profile"><br>
        <img src="{{ asset('storage/' . $user->photo_profile) }}" alt=""><br>
        <br>

        <label for="identity_card">Identity Card:</label>
        <input type="file" id="identity_card" name="identity_card"><br>
        <br>

        <label for="is_verified">Verified:</label>
        <input value="{{ $user->is_verified }}" type="checkbox" id="is_verified" name="is_verified"
            {{ $user->is_verified ? 'checked' : '' }}><br>
        <br>

        <label for="is_blocked">Blocked:</label>
        <input value="{{ $user->is_blocked }}" type="checkbox" id="is_blocked" name="is_blocked"
            {{ $user->is_blocked ? 'checked' : '' }}><br>
        <br>

        <label for="remember_token">Remember Token:</label>
        <input value="{{ $user->remember_token }}" type="text" id="remember_token" name="remember_token"><br>
        <br>

        <label for="post_id">Post ID:</label>
        <input value="{{ $user->post_id }}" type="number" id="post_id" name="post_id" required><br>
        <br>

        <button type="submit">===== Update =====</button>
    </form>
</body>

</html>

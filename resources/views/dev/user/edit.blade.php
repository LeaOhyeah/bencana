<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>

    <form method="post" action="{{ route('user.destroy', $user->id) }}">
        @method('delete')
        @csrf
        <button type="submit">
            <h4>Delete User</h4>
        </button>
    </form><br>

    <form method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <label for="full_name">Full Name:</label>
        @error('full_name')
            {{ $message }}
        @enderror
        <input value="{{ $user->full_name }}" type="text" id="full_name" name="full_name" required><br>
        <br>

        <label for="email">Email:</label>
        @error('email')
            {{ $message }}
        @enderror
        <input value="{{ $user->email }}" type="email" id="email" name="email" required><br>
        <br>

        {{-- <label for="password">Password:</label>
        @error('password')
            {{ $message }}
        @enderror
        <input value="{{ $user->password }}" type="password" id="password" name="password" required><br>
        <br> --}}

        <label for="role">Role:</label>
        @error('role')
            {{ $message }}
        @enderror
        <input value="{{ $user->role }}" type="number" id="role" name="role" required><br>
        <br>

        <label for="photo_profile">Update Photo Profile:</label>
        @error('photo_profile')
            {{ $message }}
        @enderror
        <input value="" type="file" id="photo_profile" name="photo_profile"><br>
        <input value="{{ $user->photo_profile }}" type="hidden" name="old_photo_profile" id="old_photo_profile">
        <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="" style="width: 300px;"><br>
        <a {{ $user->photo_profile ? '' : 'hidden' }} href="{{ route('user.del-pp', ['id' => $user->id]) }}">Delete
            Profile</a>
        <br>

        <label for="identity_card">Update Identity Card:</label>
        @error('identity_card')
            {{ $message }}
        @enderror
        <input type="file" id="identity_card" name="identity_card"><br>
        <input value="{{ $user->photo_profile }}" type="hidden" name="old_photo_profile" id="old_photo_profile">
        <img src="{{ asset('storage/' . $user->identity_card) }}" alt="" style="width: 300px;"><br>
        <a {{ $user->identity_card ? '' : 'hidden' }}
            href="{{ route('user.del-id-card', ['id' => $user->id]) }}">Delete Id Card</a>
        <br>

        <label for="is_verified">Verified:</label>
        @error('is_verified')
            {{ $message }}
        @enderror
        <input value="{{ $user->is_verified }}" type="checkbox" id="is_verified" name="is_verified"
            {{ $user->is_verified ? 'checked' : '' }}><br>
        <br>

        <label for="is_blocked">Blocked:</label>
        @error('is_blocked')
            {{ $message }}
        @enderror
        <input value="{{ $user->is_blocked }}" type="checkbox" id="is_blocked" name="is_blocked"
            {{ $user->is_blocked ? 'checked' : '' }}><br>
        <br>

        <label for="remember_token">Remember Token:</label>
        @error('remember_token')
            {{ $message }}
        @enderror
        <input value="{{ $user->remember_token }}" type="text" id="remember_token" name="remember_token"><br>
        <br>

        <label for="post_id">Post ID:</label>
        @error('post_id')
            {{ $message }}
        @enderror
        <input value="{{ $user->post_id }}" type="number" id="post_id" name="post_id" required><br>
        <br>

        <button type="submit">
            <h4>Update Data</h4>
        </button>
    </form>

</body>

</html>

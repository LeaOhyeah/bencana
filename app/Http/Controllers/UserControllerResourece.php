<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


/**
 * Summary of UserControllerResourece
 */
class UserControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'users' => User::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'posts' => Post::all(),
        ];
        return view('dev.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['is_verified'] = $request->has('is_verified') ? true : false;
        $request['is_blocked'] = $request->has('is_blocked') ? true : false;
        $request['password'] = trim($request['password']);
        $validateData = $request->validate([
            'full_name' => 'string',
            'email' => 'email|unique:users,email',
            'password' => 'regex:/^[A-Za-z0-9\-_]+$/|required',
            'role' => 'integer|between:1,3',
            'photo_profile' => 'image|file|max:5000',
            'identity_card' => 'image|file|max:5000',
            'is_verified' => 'boolean',
            'is_blocked' => 'boolean',
            'remember_token' => 'string|nullable',
            'post_id' => 'integer',
        ], [
            'full_name.string' => 'Nama lengkap harus string',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.regex' => 'Password hanya mengandung karakter A-Z, a-z, 0-9',
            'password.required' => 'Password tidak boleh kosong',
            'role.integer' => 'Peran tidak valid',
            'role.between' => 'Peran tersebut tidak valid',
            'photo_profile.image' => 'Format foto profil tidak valid',
            'photo_profile.file' => 'Foto profil tidak valid',
            'photo_profile.max' => 'Foto profil tidak lebih dari 5000kb',
            'identity_card.image' => 'Format kartu identitas tidak valid',
            'identity_card.file' => 'Kartu identitas tidak valid',
            'identity_card.max' => 'Kartu identitas tidak lebih dari 5000kb',
            'is_verified.boolean' => 'Verifikasi tidak valid',
            'is_blocked.boolean' => 'Blokir tidak valid',
            'remember_token.string' => 'Token harus string',
            'post_id.integer' => 'Post tidak valid',
        ]);
        $validateData['password'] = Hash::make($validateData['password']);

        if ($request->file('photo_profile')) {
            $validateData['photo_profile'] = $request->file('photo_profile')->store('user-images');
        }

        if ($request->file('identity_card')) {
            $validateData['identity_card'] = $request->file('identity_card')->store('user-images');
        }

        if (User::create($validateData)) {
            return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'posts' => Post::all(),
        ];
        return view('dev.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request['is_verified'] = $request->has('is_verified') ? true : false;
        $request['is_blocked'] = $request->has('is_blocked') ? true : false;
        $request['password'] = trim($request['password']);
        $validateData = $request->validate([
            'full_name' => 'string',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'regex:/^[A-Za-z0-9\-_]+$/|required',
            'role' => 'integer|between:1,3',
            'photo_profile' => 'image|file|max:5000',
            'identity_card' => 'image|file|max:5000',
            'is_verified' => 'boolean',
            'is_blocked' => 'boolean',
            'remember_token' => 'string|nullable',
            'post_id' => 'integer',
        ], [
            'full_name.string' => 'Nama lengkap harus string',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.regex' => 'Password hanya mengandung karakter A-Z, a-z, 0-9',
            'password.required' => 'Password tidak boleh kosong',
            'role.integer' => 'Peran tidak valid',
            'role.between' => 'Peran tersebut tidak valid',
            'photo_profile.image' => 'Format foto profil tidak valid',
            'photo_profile.file' => 'Foto profil tidak valid',
            'photo_profile.max' => 'Foto profil tidak lebih dari 5000kb',
            'identity_card.image' => 'Format kartu identitas tidak valid',
            'identity_card.file' => 'Kartu identitas tidak valid',
            'identity_card.max' => 'Kartu identitas tidak lebih dari 5000kb',
            'is_verified.boolean' => 'Verifikasi tidak valid',
            'is_blocked.boolean' => 'Blokir tidak valid',
            'remember_token.string' => 'Token harus string',
            'post_id.integer' => 'Post tidak valid',
        ]);
        $validateData['password'] = Hash::make($validateData['password']);

        if ($request->file('photo_profile')) {
            if ($request['old_photo_profile']) {
                Storage::delete($request['old_photo_profile']);
            }
            $validateData['photo_profile'] = $request->file('photo_profile')->store('user-images');
        }

        if ($request->file('identity_card')) {
            if ($request['old_identity_card']) {
                Storage::delete($request['old_identity']);
            }
            $validateData['identity_card'] = $request->file('identity_card')->store('user-images');
        }

        if (User::where('id', $user->id)->update($validateData)) {
            return back()->with('success', 'Data berhasil diperbarui!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Remove / add to trash the specified resource from storage.
     */
    public function destroy($id)
    {
        if (User::destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of the trash 
     */
    public function trash()
    {
        $data = [
            'users' => User::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.user.trash', $data);
    }

    /**
     * Restore the specified trash
     */
    public function restore(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        if ($user->restore()) {
            return redirect()->route('user.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of unvalidated users
     */
    public function request()
    {
        $data = [
            'users' => User::where('is_verified', false)->get(),
        ];
        dd($data);
    }

    /**
     * Delete a identity card (image) from storage
     */
    public function validatedUser($id)
    {
        $user = User::find($id);
        Storage::delete($user['identity_card']);
        User::where('id', $user->id)->update([
            'identity_card' => null,
            'is_verified' => true,
        ]);
        return back()->with('success', 'Kartu identitas berhasil dihapus!');
    }

    /**
     * Delete a photo profile (image) from storage
     */
    public function destroyPP($id)
    {
        $user = User::find($id);
        Storage::delete($user['photo_profile']);
        User::where('id', $user->id)->update([
            'photo_profile' => null,
        ]);
        return back()->with('success', 'Foto Profil berhasil dihapus!');
    }
}
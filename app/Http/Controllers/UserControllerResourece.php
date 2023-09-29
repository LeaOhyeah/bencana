<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\{Post};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
        return view('test.dev.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'posts' => Post::all(),
        ];
        return view('test.dev.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['is_verified'] = $request->has('is_verified') ? true : false;
        $request['is_blocked'] = $request->has('is_blocked') ? true : false;

        $validateData = $request->validate([
            'full_name' => 'string',
            'email' => 'email|unique:users,email',
            'password' => 'regex:/^[A-Za-z0-9\-_]+$/',
            'role' => 'integer|between:1,3',
            'photo_profile' => 'image|file|max:5000',
            'identity_card' => 'max:255',
            'is_verified' => 'boolean',
            'is_blocked' => 'boolean',
            'remember_token' => 'string|nullable',
            'post_id' => 'integer',
        ], [
            'full_name.string' => 'error string full name',
            'email.email' => 'error email email',
            'email.unique' => 'error unique email',
            'password.regex' => 'error regex password',
            'role.integer' => 'error integer role',
            'role.between' => 'error between role',
            'photo_profile.image' => 'error image photo profile',
            'photo_profile.file' => 'error file photo profile',
            'photo_profile.max' => 'error max photo profile',
            'identity_card.max' => 'error max identity card',
            'is_verified.boolean' => 'error boolean verified',
            'is_blocked.boolean' => 'error boolean blocked',
            'remember_token.string' => 'error token',
            'post_id.integer' => 'error integer post id',
        ]);
        $validateData['password'] = Hash::make($validateData['password']);

        if ($request->file('photo_profile')) {
            $validateData['photo_profile'] = $request->file('photo_profile')->store('user-images');
        }

        if (User::create($validateData)) {
            return $validateData;
        }
        return "error";

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
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
        return view('test.dev.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
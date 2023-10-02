<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Disaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'posts' => Post::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'disasters' => Disaster::all(),
        ];
        return view('dev.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:posts,code',
            'disaster_id' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'photo' => 'image|file|max:5000',
            'lat' => '',
            'long' => '',
        ], [
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'disaster_id.integer' => 'error disaster id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'photo.image' => 'error image photo',
            'photo.file' => 'error file photo',
            'photo.max' => 'error max photo',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;

        if ($request->file('photo')) {
            $validateData['photo'] = $request->file('photo')->store('post-images');
        }

        if (Post::create($validateData)) {
            return redirect()->route('post.index');
        }
        return "error";
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $data = [
            'post' => $post,
            'disasters' => Disaster::all(),
        ];
        return view('dev.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:posts,code,' . $post->id,
            'disaster_id' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'photo' => 'image|file|max:5000',
            'lat' => '',
            'long' => '',
        ], [
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'disaster_id.integer' => 'error disaster id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'photo.image' => 'error image photo',
            'photo.file' => 'error file photo',
            'photo.max' => 'error max photo',
        ]);
        $validateData['edited_by'] = 1;

        if ($request->file('photo')) {
            if ($request['old_photo']) {
                Storage::delete($request['old_photo']);
            }
            $validateData['photo'] = $request->file('photo')->store('post-images');
        }

        if (Post::where('id', $post->id)->update($validateData)) {
            return back();
        }
        return "error";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = [
            'edited_by' => 1,
        ];
        Post::where('id', $id)->update($data);
        if (Post::destroy($id)) {
            return redirect()->route('post.index');
        }
        return "error";
    }

    /**
     * Display a listing of the trash 
     */
    public function trash()
    {
        $data = [
            'posts' => Post::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.post.trash', $data);
    }

    /**
     * Restore the specified trash
     */
    public function restore(Request $request)
    {
        $data = [
            'edited_by' => 1,
        ];
        $post = Post::withTrashed()->find($request->id);
        $post->update($data);
        if ($post->restore()) {
            return redirect()->route('post.trash');
        }
        return "error";
    }
}
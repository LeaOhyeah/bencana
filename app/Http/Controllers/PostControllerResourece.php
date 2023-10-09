<?php

namespace App\Http\Controllers;

use App\Models\Disaster;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


/**
 * Summary of PostControllerResourece
 */
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
            'lat' => 'required',
            'long' => 'required',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'disaster_id.integer' => 'Bencana tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'photo.image' => 'Format Foto tidak valid',
            'photo.file' => 'Foto tidak valid',
            'photo.max' => 'Foto tidak lebih dari 5000kb',
            'lat.required' => 'Garis lintang tidak valid',
            'long.required' => 'Garis lintang tidak valid',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;
        // $validateData['created_by'] = Auth::user()->id;
        // $validateData['edited_by'] = Auth::user()->id;

        if ($request->file('photo')) {
            $validateData['photo'] = $request->file('photo')->store('post-images');
        }

        if (Post::create($validateData)) {
            return redirect()->route('post.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
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
            'lat' => 'required',
            'long' => 'required',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'disaster_id.integer' => 'Bencana tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'photo.image' => 'Format Foto tidak valid',
            'photo.file' => 'Foto tidak valid',
            'photo.max' => 'Foto tidak lebih dari 5000kb',
            'lat.required' => 'Garis lintang tidak valid',
            'long.required' => 'Garis lintang tidak valid',
        ]);
        $validateData['edited_by'] = 1;
        // $validateData['edited_by'] = Auth::user()->id;

        if ($request->file('photo')) {
            if ($request['old_photo']) {
                Storage::delete($request['old_photo']);
            }
            $validateData['photo'] = $request->file('photo')->store('post-images');
        }

        if (Post::where('id', $post->id)->update($validateData)) {
            return back()->with('success', 'Data berhasil diperbarui!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = [
            // 'edited_by' => Auth::user()->id,
            'edited_by' => 1,
        ];
        Post::where('id', $id)->update($data);
        if (Post::destroy($id)) {
            return redirect()->route('post.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Terjadi kesalahan!');
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
            // 'edited_by' => Auth::user()->id,
            'edited_by' => 1,
        ];
        $post = Post::withTrashed()->find($request->id);
        $post->update($data);
        if ($post->restore()) {
            return redirect()->route('post.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
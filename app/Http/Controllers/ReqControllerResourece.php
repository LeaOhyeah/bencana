<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReqControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'reqs' => Req::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.req.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'posts' => Post::all(),
            'categories' => Category::all(),
        ];
        return view('dev.req.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:reqs,code',
            'post_id' => 'integer',
            'category_id' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'quantity' => 'integer',
            'unit' => 'string',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'post_id.integer' => 'Pos tidak valid',
            'category_id.integer' => 'Kategori tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'quantity.integer' => 'Kuantitas tidak valid',
            'unit.string' => 'Unit harus string',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;
        // $validateData['created_by'] = Auth::user()->id;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Req::create($validateData)) {
            return redirect()->route('req.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Req $req)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Req $req)
    {
        $data = [
            'req' => $req,
            'posts' => Post::all(),
            'categories' => Category::all(),
        ];
        return view('dev.req.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Req $req)
    {
        $request['is_completed'] = $request->has('is_completed') ? true : false;
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:reqs,code,' . $req->id,
            'post_id' => 'integer',
            'category_id' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'quantity' => 'integer',
            'unit' => 'string',
            'is_completed' => 'boolean',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'post_id.integer' => 'Pos tidak valid',
            'category_id.integer' => 'Kategori tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'quantity.integer' => 'Kuantitas tidak valid',
            'unit.string' => 'Unit harus string',
            'is_completed.boolean' => 'Terselesaikan tidak valid',
        ]);
        $validateData['edited_by'] = 1;

        if (Req::where('id', $req->id)->update($validateData)) {
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
        Req::where('id', $id)->update($data);
        if (Req::destroy($id)) {
            return redirect()->route('req.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of the trash 
     */
    public function trash()
    {
        $data = [
            'reqs' => Req::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.req.trash', $data);
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
        $req = Req::withTrashed()->find($request->id);
        $req->update($data);
        if ($req->restore()) {
            return redirect()->route('req.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
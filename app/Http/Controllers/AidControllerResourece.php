<?php

namespace App\Http\Controllers;

use App\Models\Aid;
use App\Models\Category;
use App\Models\Post;
use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of AidControllerResourece
 */
class AidControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'aids' => Aid::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.aid.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'posts' => Post::all(),
            'categories' => Category::all(),
            'reqs' => Req::all(),
        ];
        return view('dev.aid.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['is_over'] = $request->has('is_over') ? true : false;
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:aids,code',
            'post_id' => 'integer',
            'category_id' => 'integer',
            'req_id' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'is_over' => 'boolean',
            'quantity' => 'integer',
            'unit' => 'string',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'post_id.integer' => 'Post tidak valid',
            'category_id.integer' => 'Kategori tidak valid',
            'req_id.integer' => 'Permintaan tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'is_over.boolean' => 'Kelebihan tidak valid',
            'quantity.integer' => 'Kuantitas tidak valid',
            'unit.string' => 'Unit harus string',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;
        // $validateData['created_by'] = Auth::user()->id;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Aid::create($validateData)) {
            return redirect()->route('aid.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aid $aid)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aid $aid)
    {
        $data = [
            'aid' => $aid,
            'posts' => Post::all(),
            'categories' => Category::all(),
            'reqs' => Req::all(),
        ];
        return view('dev.aid.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aid $aid)
    {
        $request['is_over'] = $request->has('is_over') ? true : false;
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:aids,code,' . $aid->id,
            'post_id' => 'integer',
            'category_id' => 'integer',
            'req_id ' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'is_over' => 'boolean',
            'quantity' => 'integer',
            'unit' => 'string',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'post_id.integer' => 'Post tidak valid',
            'category_id.integer' => 'Kategori tidak valid',
            'req_id.integer' => 'Permintaan tidak valid',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'is_over.boolean' => 'Kelebihan tidak valid',
            'quantity.integer' => 'Kuantitas tidak valid',
            'unit.string' => 'Unit harus string',
        ]);
        $validateData['edited_by'] = 1;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Aid::where('id', $aid->id)->update($validateData)) {
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
            'edited_by' => 1,
            // 'edited_by' => Auth::user()->id,
        ];
        Aid::where('id', $id)->update($data);
        if (Aid::destroy($id)) {
            return redirect()->route('aid.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of the trash 
     */
    public function trash()
    {
        $data = [
            'aids' => Aid::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.aid.trash', $data);
    }

    /**
     * Restore the specified trash
     */
    public function restore(Request $request)
    {
        $data = [
            'edited_by' => 1,
            // 'edited_by' => Auth::user()->id,
        ];
        $aid = Aid::withTrashed()->find($request->id);
        $aid->update($data);
        if ($aid->restore()) {
            return redirect()->route('aid.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
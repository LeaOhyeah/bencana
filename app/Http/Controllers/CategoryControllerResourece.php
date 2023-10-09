<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of CategoryControllerResourece
 */
class CategoryControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => Category::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dev.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'max:30|unique:categories,name',
        ], [
            'name.max' => 'Kategori tidak lebih dari 30 karakter',
            'name.unique' => 'Kategori sudah ada',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;
        // $validateData['created_by'] = Auth::user()->id;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Category::create($validateData)) {
            return redirect()->route('category.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'category' => $category,
        ];
        return view('dev.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate([
            'name' => 'max:30|unique:categories,name,' . $category->id,
        ], [
            'name.max' => 'Kategori tidak lebih dari 30 karakter',
            'name.unique' => 'Kategori sudah ada',
        ]);
        $validateData['edited_by'] = 1;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Category::where('id', $category->id)->update($validateData)) {
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
        Category::where('id', $id)->update($data);
        if (Category::destroy($id)) {
            return redirect()->route('category.index')->with('success', 'Data berhasil dihapus!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of the trash 
     */
    public function trash()
    {
        $data = [
            'categories' => Category::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.category.trash', $data);
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
        $category = Category::withTrashed()->find($request->id);
        $category->update($data);
        if ($category->restore()) {
            return redirect()->route('category.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
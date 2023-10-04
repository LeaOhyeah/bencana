<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
            'name.max' => 'error name max',
            'name.unique' => 'error name unique',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;

        if (Category::create($validateData)) {
            return redirect()->route('category.index');
        }
        return "error";
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
            'name.max' => 'error name max',
            'name.unique' => 'error name unique',
        ]);
        $validateData['edited_by'] = 1;

        if (Category::where('id', $category->id)->update($validateData)) {
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
        Category::where('id', $id)->update($data);
        if (Category::destroy($id)) {
            return redirect()->route('category.index');
        }
        return "error";
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
        ];
        $category = Category::withTrashed()->find($request->id);
        $category->update($data);
        if ($category->restore()) {
            return redirect()->route('category.trash');
        }
        return "error";
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Req;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

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
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'post_id.integer' => 'error post id',
            'category_id.integer' => 'error category id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'quantity.integer' => 'error quantity integer',
            'unit.string' => 'error unit string',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;

        if (Req::create($validateData)) {
            return redirect()->route('req.index');
        }
        return "error";

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
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'post_id.integer' => 'error post id',
            'category_id.integer' => 'error category id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'quantity.integer' => 'error quantity integer',
            'unit.string' => 'error unit string',
            'is_completed.boolean' => 'error is completed boolean'
        ]);
        $validateData['edited_by'] = 1;

        if (Req::where('id', $req->id)->update($validateData)) {
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
        Req::where('id', $id)->update($data);
        if (Req::destroy($id)) {
            return redirect()->route('req.index');
        }
        return "error";
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
            'edited_by' => 1,
        ];
        $req = Req::withTrashed()->find($request->id);
        $req->update($data);
        if ($req->restore()) {
            return redirect()->route('req.trash');
        }
        return "error";
    }
}
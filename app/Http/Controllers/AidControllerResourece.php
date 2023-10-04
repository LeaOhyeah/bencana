<?php

namespace App\Http\Controllers;

use App\Models\Aid;
use App\Models\Req;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

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
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'post_id.integer' => 'error post id',
            'category_id.integer' => 'error category id',
            'req_id.integer' => 'error req id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'is_over.boolean' => 'error is over boolean',
            'quantity.integer' => 'error quantity integer',
            'unit.string' => 'error unit string',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;

        if (Aid::create($validateData)) {
            return redirect()->route('aid.index');
        }
        return "error";
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
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:aids,code,' .$aid->id,
            'post_id' => 'integer',
            'category_id' => 'integer',
            'req_id ' => 'integer',
            'name' => 'string',
            'description' => 'max:500',
            'is_over' => 'boolean',
            'quantity' => 'integer',
            'unit' => 'string',
        ], [
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'post_id.integer' => 'error post id',
            'category_id.integer' => 'error category id',
            'req_id.integer' => 'error req id',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'is_over.boolean' => 'error is over boolean',
            'quantity.integer' => 'error quantity integer',
            'unit.string' => 'error unit string',
        ]);
        $validateData['edited_by'] = 1;

        if (Aid::where('id', $aid->id)->update($validateData)) {
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
        Aid::where('id', $id)->update($data);
        if (Aid::destroy($id)) {
            return redirect()->route('aid.index');
        }
        return "error";
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
        ];
        $aid = Aid::withTrashed()->find($request->id);
        $aid->update($data);
        if ($aid->restore()) {
            return redirect()->route('aid.trash');
        }
        return "error";
    }
}
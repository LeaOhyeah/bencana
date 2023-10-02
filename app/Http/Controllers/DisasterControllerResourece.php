<?php

namespace App\Http\Controllers;

use App\Models\Disaster;
use Illuminate\Http\Request;

class DisasterControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'disasters' => Disaster::orderBy('created_at', 'ASC')->get(),
        ];
        return view('dev.disaster.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dev.disaster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:disasters,code',
            'name' => 'string',
            'description' => 'max:500',
            'start_date' => 'date',
            'end_date' => 'date|nullable',
            'closed_date' => 'date|nullable',
            'lat' => '',
            'long' => '',
        ], [
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'start_date.date' => 'error start date',
            'end_date.date' => 'error end date',
            'closed_date.date' => 'error closed date',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;

        if (Disaster::create($validateData)) {
            return redirect()->route('disaster.index');
        }
        return "error";

    }

    /**
     * Display the specified resource.
     */
    public function show(Disaster $disaster)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disaster $disaster)
    {
        $data = [
            'disaster' => $disaster,
        ];
        return view('dev.disaster.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disaster $disaster)
    {
        $validateData = $request->validate([
            'code' => 'regex:/^[A-Z0-9\-]+$/|unique:disasters,code,' . $disaster->id,
            'name' => 'string',
            'description' => 'max:500',
            'start_date' => 'date',
            'end_date' => 'date|nullable',
            'closed_date' => 'date|nullable',
            'lat' => '',
            'long' => '',
        ], [
            'code.regex' => 'error regex code',
            'code.unique' => 'error unique code',
            'name.string' => 'error string name',
            'description.max' => 'error max description',
            'start_date.date' => 'error start date',
            'end_date.date' => 'error end date',
            'closed_date.date' => 'error closed date',
        ]);
        $validateData['edited_by'] = 1;

        if (Disaster::where('id', $disaster->id)->update($validateData)) {
            return back();
        }
        return "error";

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data =[
            'edited_by' => 1,
        ];
        Disaster::where('id', $id)->update($data);
        if (Disaster::destroy($id)) {
            return redirect()->route('disaster.index');
        }
        return "error";
    }

    public function trash()
    {
        $data = [
            'disasters' => Disaster::onlyTrashed()->orderBy('deleted_at', 'DESC')->get(),
        ];
        return view('dev.disaster.trash', $data);
    }

    /**
     * Restore the specified trash
     */
    public function restore(Request $request)
    {
        $data = [
            'edited_by' => 1,
        ];
        $disaster = Disaster::withTrashed()->find($request->id);
        $disaster->update($data);
        if ($disaster->restore()) {
            return redirect()->route('disaster.trash');
        }
        return "error";
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Disaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of DisasterControllerResourece
 */
class DisasterControllerResourece extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'disasters' => Disaster::with(['edited_log', 'created_log'])->orderBy('created_at', 'ASC')->get(),
        ];
        $test = Disaster::find(1);
        dd($test->created_at_formated());
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
            'lat' => 'required',
            'long' => 'required',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'start_date.date' => 'Tanggal dimulai tidak valid',
            'end_date.date' => 'Tanggal selesai tidak valid',
            'closed_date.date' => 'Tanggal ditutup tidak valid',
            'lat.required' => 'Garis lintang tidak valid',
            'long.required' => 'Garis bujur tidak valid',
        ]);
        $validateData['created_by'] = 1;
        $validateData['edited_by'] = 1;
        // $validateData['created_by'] = Auth::user()->id;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Disaster::create($validateData)) {
            return redirect()->route('disaster.index')->with('success', 'Data berhasil ditambahkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
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
            'lat' => 'required',
            'long' => 'required',
        ], [
            'code.regex' => 'Kode hanya mengandung karakter A-Z, 0-9 -',
            'code.unique' => 'Kode sudah ada',
            'name.string' => 'Nama harus string',
            'description.max' => 'Deskirpsi tidak lebih dari 500 karakter',
            'start_date.date' => 'Tanggal dimulai tidak valid',
            'end_date.date' => 'Tanggal selesai tidak valid',
            'closed_date.date' => 'Tanggal ditutup tidak valid',
            'lat.required' => 'Garis lintang tidak valid',
            'long.required' => 'Garis bujur tidak valid',
        ]);
        $validateData['edited_by'] = 1;
        // $validateData['edited_by'] = Auth::user()->id;

        if (Disaster::where('id', $disaster->id)->update($validateData)) {
            return back()->with('success', 'Data berhasil diperbarui!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data =[
            'edited_by' => 1,
            // 'edited_by' => Auth::user()->id,
        ];
        Disaster::where('id', $id)->update($data);
        if (Disaster::destroy($id)) {
            return redirect()->route('disaster.index')->with('success', 'Data berhasil dihapus');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }

    /**
     * Display a listing of the trash 
     */
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
            // 'edited_by' => Auth::user()->id,
        ];
        $disaster = Disaster::withTrashed()->find($request->id);
        $disaster->update($data);
        if ($disaster->restore()) {
            return redirect()->route('disaster.trash')->with('success', 'Data berhasil dipulihkan!');
        }
        return back()->with('error', 'Terjadi kesalahan!');
    }
}
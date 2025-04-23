<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan; 

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('ruangans.index', compact('ruangans'));
    }

    public function indexUser()
    {
        $ruangans = Ruangan::all();
        return view('user.ruangan.index', compact('ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
            'lokasi' => 'nullable',
        ]);

        Ruangan::create($request->all());
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('ruangans.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
            'lokasi' => 'nullable',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materis = Materi::latest()->paginate(10);
        return view('materi.index', compact('materis'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan data ke database
        Materi::create($validated);

        // Redirect kembali ke halaman materi dengan pesan sukses
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dibuat.');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Cari materi berdasarkan ID
        $materi = Materi::findOrFail($id);

        // Update data materi dengan data yang sudah divalidasi
        $materi->update($validated);

        // Redirect kembali ke halaman materi dengan pesan sukses
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari materi berdasarkan ID
        $materi = Materi::findOrFail($id);

        // Hapus data materi tersebut
        $materi->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}

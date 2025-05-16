<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::latest()->paginate(10);
        return view('pesertas.index', compact('pesertas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'asal_delegasi' => 'required|string|max:100',
           'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',

        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')
                         ->with('success', 'Peserta berhasil ditambahkan');
    }

   public function update(Request $request, $id)
{
    $peserta = Peserta::findOrFail($id);

    $validated = $request->validate([
        'nama' => 'required',
        'asal_delegasi' => 'required',
        'jenis_kelamin' => 'required',
    ]);

    $peserta->update($validated);

    return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diupdate');
}

   public function destroy($id)
{
    $peserta = Peserta::findOrFail($id);
    $peserta->delete();

    return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus');
}
}

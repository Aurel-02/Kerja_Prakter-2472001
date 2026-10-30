<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulumList = Kurikulum::all();

        return view('admin.kurikulum', compact('kurikulumList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $sekolah = Sekolah::first();
        $idProfil = $sekolah ? $sekolah->id_profil : 1;

        Kurikulum::create(array_merge($validated, ['id_profil' => $idProfil]));

        return redirect()->route('admin.kurikulum')->with('success', 'Data kurikulum berhasil ditambahkan!');
    }

    public function update(Request $request, int $id)
    {
        $kurikulum = Kurikulum::findOrFail($id);

        $validated = $request->validate([
            'kategori' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kurikulum->update($validated);

        return redirect()->route('admin.kurikulum')->with('success', 'Data kurikulum berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $kurikulum = Kurikulum::findOrFail($id);
        $kurikulum->delete();

        return redirect()->route('admin.kurikulum')->with('success', 'Data kurikulum berhasil dihapus!');
    }
}


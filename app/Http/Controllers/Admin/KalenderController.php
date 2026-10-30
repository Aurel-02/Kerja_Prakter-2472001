<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index()
    {
        $kalenderList = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();

        return view('admin.kalender', compact('kalenderList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:50',
            'kategori' => 'nullable|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $sekolah = Sekolah::first();
        $idProfil = $sekolah ? $sekolah->id_profil : 1;

        KalenderAkademik::create(array_merge($validated, ['id_profil' => $idProfil]));

        return redirect()->route('admin.kalender')->with('success', 'Agenda kalender berhasil ditambahkan!');
    }

    public function update(Request $request, int $id)
    {
        $kalender = KalenderAkademik::findOrFail($id);

        $validated = $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:50',
            'kategori' => 'nullable|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $kalender->update($validated);

        return redirect()->route('admin.kalender')->with('success', 'Agenda kalender berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $kalender = KalenderAkademik::findOrFail($id);
        $kalender->delete();

        return redirect()->route('admin.kalender')->with('success', 'Agenda kalender berhasil dihapus!');
    }
}


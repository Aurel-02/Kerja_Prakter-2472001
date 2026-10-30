<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Models\StrukturSekolah;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guruList = StrukturSekolah::orderBy('nama', 'asc')->get();

        return view('admin.guru', compact('guruList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:struktur_sekolah,nip',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $sekolah = Sekolah::first();
        $idProfil = $sekolah ? $sekolah->id_profil : 1;

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $filename);
            $fotoPath = 'uploads/guru/'.$filename;
        }

        StrukturSekolah::create([
            'nip' => $validated['nip'],
            'id_profil' => $idProfil,
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'pendidikan' => $validated['pendidikan'] ?? null,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.guru')->with('success', 'Data struktur/guru berhasil ditambahkan!');
    }

    public function update(Request $request, string $nip)
    {
        $guru = StrukturSekolah::where('nip', $nip)->firstOrFail();

        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:struktur_sekolah,nip,'.$nip.',nip',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'pendidikan' => 'nullable|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fotoPath = $guru->foto;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/guru'), $filename);
            $fotoPath = 'uploads/guru/'.$filename;
        }

        $guru->update([
            'nip' => $validated['nip'],
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'pendidikan' => $validated['pendidikan'] ?? null,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.guru')->with('success', 'Data struktur/guru berhasil diperbarui!');
    }

    public function destroy(string $nip)
    {
        $guru = StrukturSekolah::where('nip', $nip)->firstOrFail();
        $guru->delete();

        return redirect()->route('admin.guru')->with('success', 'Data struktur/guru berhasil dihapus!');
    }
}


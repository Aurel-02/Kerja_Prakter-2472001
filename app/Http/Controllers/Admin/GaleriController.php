<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeriList = Galeri::latest()->get();

        return view('admin.galeri', compact('galeriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'link_foto' => 'nullable|string|max:255',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $sekolah = Sekolah::first();
        $idProfil = $sekolah ? $sekolah->id_profil : 1;

        $linkFoto = $validated['link_foto'] ?? 'adward/images/kids.jpg';
        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $filename);
            $linkFoto = 'uploads/galeri/'.$filename;
        }

        Galeri::create([
            'id_profil' => $idProfil,
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'] ?? null,
            'link_foto' => $linkFoto,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function update(Request $request, int $id)
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'link_foto' => 'nullable|string|max:255',
            'foto_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $linkFoto = $validated['link_foto'] ?? $galeri->link_foto;
        if ($request->hasFile('foto_file')) {
            $file = $request->file('foto_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/galeri'), $filename);
            $linkFoto = 'uploads/galeri/'.$filename;
        }

        $galeri->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'] ?? null,
            'link_foto' => $linkFoto,
            'deskripsi' => $validated['deskripsi'] ?? null,
        ]);

        return redirect()->route('admin.galeri')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(int $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('admin.galeri')->with('success', 'Foto galeri berhasil dihapus!');
    }
}


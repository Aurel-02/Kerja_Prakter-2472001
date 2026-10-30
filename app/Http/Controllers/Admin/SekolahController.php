<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'deskripsi_profil' => 'nullable|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'link_maps' => 'nullable|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        $sekolah = Sekolah::first();

        if ($sekolah) {
            $sekolah->update($validated);
        } else {
            Sekolah::create($validated);
        }

        return back()->with('success', 'Data Profil, Visi, dan Misi Sekolah berhasil diperbarui!');
    }
}


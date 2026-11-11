<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    /**
     * Tampilkan daftar Orang Tua / Wali
     */
    public function index()
    {
        $orangTuaList = OrangTuaWali::with('siswa')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.orang-tua', compact('orangTuaList'));
    }

    /**
     * Simpan data Orang Tua / Wali baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'no_telp'           => 'required|string|max:50',
            'qr_code_penjemput' => 'nullable|string|max:255|unique:orang_tua_wali,qr_code_penjemput',
        ], [
            'nama.required'     => 'Nama orang tua / wali wajib diisi.',
            'no_telp.required'  => 'Nomor telepon wajib diisi.',
            'qr_code_penjemput.unique' => 'Kode QR ini sudah digunakan oleh orang tua / wali lain.',
        ]);

        OrangTuaWali::create([
            'nama'              => $request->nama,
            'no_telp'           => $request->no_telp,
            'qr_code_penjemput' => $request->qr_code_penjemput ?: 'QR-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('admin.orang-tua')
            ->with('success', 'Data orang tua / wali berhasil ditambahkan.');
    }

    /**
     * Update data Orang Tua / Wali
     */
    public function update(Request $request, $id)
    {
        $ortu = OrangTuaWali::findOrFail($id);

        $request->validate([
            'nama'              => 'required|string|max:255',
            'no_telp'           => 'required|string|max:50',
            'qr_code_penjemput' => 'nullable|string|max:255|unique:orang_tua_wali,qr_code_penjemput,' . $id . ',id_ortu_wali',
        ]);

        $ortu->update([
            'nama'              => $request->nama,
            'no_telp'           => $request->no_telp,
            'qr_code_penjemput' => $request->qr_code_penjemput ?: $ortu->qr_code_penjemput,
        ]);

        return redirect()->route('admin.orang-tua')
            ->with('success', 'Data orang tua / wali berhasil diperbarui.');
    }

    /**
     * Hapus data Orang Tua / Wali
     */
    public function destroy($id)
    {
        $ortu = OrangTuaWali::findOrFail($id);
        $nama = $ortu->nama;
        $ortu->delete();

        return redirect()->route('admin.orang-tua')
            ->with('success', 'Data ' . $nama . ' berhasil dihapus.');
    }
}


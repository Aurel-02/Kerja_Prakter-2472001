<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Tampilkan data siswa-siswi
     */
    public function index()
    {
        $siswaList = Siswa::with('orangTua')
            ->orderBy('nama', 'asc')
            ->get();

        $orangTuaList = OrangTuaWali::orderBy('nama', 'asc')->get();

        return view('admin.siswa', compact('siswaList', 'orangTuaList'));
    }

    /**
     * Simpan data siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|max:50|unique:siswa,nis',
            'jenis_kelamin' => 'required|string|max:20',
            'tahun_ajaran'  => 'nullable|string|max:50',
            'id_ortu_wali'  => 'nullable|exists:orang_tua_wali,id_ortu_wali',
            'qr_code_siswa' => 'nullable|string|max:255|unique:siswa,qr_code_siswa',
        ], [
            'nama.required' => 'Nama siswa wajib diisi.',
            'nis.required'  => 'NIS siswa wajib diisi.',
            'nis.unique'    => 'NIS ini sudah terdaftar.',
            'qr_code_siswa.unique' => 'Kode QR ini sudah digunakan oleh siswa lain.',
        ]);

        Siswa::create([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran'  => $request->tahun_ajaran ?: '2026/2027',
            'status'        => 'aktif',
            'id_ortu_wali'  => $request->id_ortu_wali,
            'qr_code_siswa' => $request->qr_code_siswa ?: 'SISWA-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'nis'           => 'required|string|max:50|unique:siswa,nis,' . $id . ',id_siswa',
            'jenis_kelamin' => 'required|string|max:20',
            'tahun_ajaran'  => 'nullable|string|max:50',
            'id_ortu_wali'  => 'nullable|exists:orang_tua_wali,id_ortu_wali',
            'qr_code_siswa' => 'nullable|string|max:255|unique:siswa,qr_code_siswa,' . $id . ',id_siswa',
        ]);

        $siswa->update([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran'  => $request->tahun_ajaran ?: $siswa->tahun_ajaran,
            'id_ortu_wali'  => $request->id_ortu_wali,
            'qr_code_siswa' => $request->qr_code_siswa ?: $siswa->qr_code_siswa,
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data siswa
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $nama = $siswa->nama;
        $siswa->delete();

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa ' . $nama . ' berhasil dihapus.');
    }
}


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
     * Simpan data siswa baru beserta data orang tua/wali
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'nis'               => 'required|string|max:50|unique:siswa,nis',
            'jenis_kelamin'     => 'required|string|max:20',
            'tahun_ajaran'      => 'nullable|string|max:50',
            'qr_code_siswa'     => 'required|string|max:255|unique:siswa,qr_code_siswa',
            'nama_ortu'         => 'required|string|max:255',
            'no_telp_ortu'      => 'required|string|max:50',
            'qr_code_penjemput' => 'required|string|max:255|unique:orang_tua_wali,qr_code_penjemput',
        ], [
            'nama.required'              => 'Nama siswa wajib diisi.',
            'nis.required'               => 'NIS siswa wajib diisi.',
            'nis.unique'                 => 'NIS ini sudah terdaftar.',
            'qr_code_siswa.required'     => 'Kode QR siswa wajib diisi secara manual.',
            'qr_code_siswa.unique'       => 'Kode QR siswa ini sudah digunakan oleh siswa lain.',
            'nama_ortu.required'         => 'Nama orang tua / wali wajib diisi.',
            'no_telp_ortu.required'      => 'Nomor telepon orang tua wajib diisi.',
            'qr_code_penjemput.required' => 'Kode QR penjemput wajib diisi secara manual.',
            'qr_code_penjemput.unique'   => 'Kode QR penjemput ini sudah digunakan oleh orang tua lain.',
        ]);

        // Simpan data Orang Tua terlebih dahulu
        $ortu = OrangTuaWali::create([
            'nama'              => $request->nama_ortu,
            'no_telp'           => $request->no_telp_ortu,
            'qr_code_penjemput' => trim($request->qr_code_penjemput),
        ]);

        // Simpan data Siswa terhubung ke Orang Tua
        Siswa::create([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran'  => $request->tahun_ajaran ?: '2026/2027',
            'status'        => 'aktif',
            'id_ortu_wali'  => $ortu->id_ortu_wali,
            'qr_code_siswa' => trim($request->qr_code_siswa),
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa dan data orang tua berhasil ditambahkan.');
    }

    /**
     * Update data siswa beserta data orang tua/wali
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $ortuId = $siswa->id_ortu_wali;

        $request->validate([
            'nama'              => 'required|string|max:255',
            'nis'               => 'required|string|max:50|unique:siswa,nis,' . $id . ',id_siswa',
            'jenis_kelamin'     => 'required|string|max:20',
            'tahun_ajaran'      => 'nullable|string|max:50',
            'qr_code_siswa'     => 'required|string|max:255|unique:siswa,qr_code_siswa,' . $id . ',id_siswa',
            'nama_ortu'         => 'required|string|max:255',
            'no_telp_ortu'      => 'required|string|max:50',
            'qr_code_penjemput' => 'required|string|max:255|unique:orang_tua_wali,qr_code_penjemput,' . ($ortuId ?: 'NULL') . ',id_ortu_wali',
        ], [
            'nama.required'              => 'Nama siswa wajib diisi.',
            'nis.required'               => 'NIS siswa wajib diisi.',
            'nis.unique'                 => 'NIS ini sudah terdaftar.',
            'qr_code_siswa.required'     => 'Kode QR siswa wajib diisi.',
            'qr_code_siswa.unique'       => 'Kode QR siswa ini sudah digunakan oleh siswa lain.',
            'nama_ortu.required'         => 'Nama orang tua / wali wajib diisi.',
            'no_telp_ortu.required'      => 'Nomor telepon orang tua wajib diisi.',
            'qr_code_penjemput.required' => 'Kode QR penjemput wajib diisi.',
            'qr_code_penjemput.unique'   => 'Kode QR penjemput ini sudah digunakan oleh orang tua lain.',
        ]);

        // Update data Orang Tua jika sudah ada, atau buat baru jika belum terhubung
        if ($siswa->orangTua) {
            $siswa->orangTua->update([
                'nama'              => $request->nama_ortu,
                'no_telp'           => $request->no_telp_ortu,
                'qr_code_penjemput' => trim($request->qr_code_penjemput),
            ]);
        } else {
            $ortu = OrangTuaWali::create([
                'nama'              => $request->nama_ortu,
                'no_telp'           => $request->no_telp_ortu,
                'qr_code_penjemput' => trim($request->qr_code_penjemput),
            ]);
            $siswa->id_ortu_wali = $ortu->id_ortu_wali;
        }

        // Update data Siswa
        $siswa->update([
            'nama'          => $request->nama,
            'nis'           => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tahun_ajaran'  => $request->tahun_ajaran ?: $siswa->tahun_ajaran,
            'qr_code_siswa' => trim($request->qr_code_siswa),
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa dan orang tua berhasil diperbarui.');
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


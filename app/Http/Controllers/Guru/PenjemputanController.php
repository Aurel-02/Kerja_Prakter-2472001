<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;
use App\Models\Penjemputan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjemputanController extends Controller
{
    /**
     * Tampilkan halaman Scan QR Penjemputan
     */
    public function scanQr()
    {
        $riwayatHariIni = Penjemputan::with(['siswa', 'orangTua'])
            ->whereDate('waktu', today())
            ->orderBy('waktu', 'desc')
            ->take(10)
            ->get();

        return view('guru.scan', compact('riwayatHariIni'));
    }

    /**
     * Langkah 1: Cek & Validasi Kode QR Siswa
     */
    public function cekSiswa(Request $request)
    {
        $kode = trim($request->input('kode'));
        if (!$kode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode QR siswa tidak boleh kosong.'
            ], 400);
        }

        // Cari berdasarkan qr_code_siswa, nis, atau id_siswa
        $siswa = Siswa::with('orangTua')
            ->where('qr_code_siswa', $kode)
            ->orWhere('nis', $kode)
            ->orWhere('id_siswa', $kode)
            ->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa dengan kode "' . $kode . '" tidak ditemukan di sistem.'
            ], 404);
        }

        // Cek apakah siswa sudah dijemput hari ini
        $sudahDijemput = Penjemputan::where('id_siswa', $siswa->id_siswa)
            ->whereDate('waktu', today())
            ->where('status', 'selesai')
            ->latest('waktu')
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil ditemukan.',
            'siswa' => [
                'id_siswa' => $siswa->id_siswa,
                'nama' => $siswa->nama,
                'nis' => $siswa->nis ?? '-',
                'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
                'status' => $siswa->status ?? 'Aktif',
                'id_ortu_wali' => $siswa->id_ortu_wali,
                'nama_ortu' => $siswa->orangTua ? $siswa->orangTua->nama : 'Belum dihubungkan',
                'no_telp_ortu' => $siswa->orangTua ? $siswa->orangTua->no_telp : '-',
            ],
            'sudah_dijemput' => $sudahDijemput ? [
                'waktu' => $sudahDijemput->waktu->format('H:i') . ' WIB',
                'keterangan' => $sudahDijemput->keterangan,
            ] : null,
        ]);
    }

    /**
     * Langkah 2: Cek & Verifikasi Kode QR Orang Tua / Wali terhadap Siswa Terpilih
     */
    public function cekOrtu(Request $request)
    {
        $idSiswa = $request->input('id_siswa');
        $kodeOrtu = trim($request->input('kode_ortu'));

        if (!$idSiswa || !$kodeOrtu) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa dan kode penjemput wajib diisi.'
            ], 400);
        }

        $siswa = Siswa::with('orangTua')->find($idSiswa);
        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan.'
            ], 404);
        }

        // Cari orang tua berdasarkan qr_code_penjemput atau id_ortu_wali
        $ortuScanned = OrangTuaWali::where('qr_code_penjemput', $kodeOrtu)
            ->orWhere('id_ortu_wali', $kodeOrtu)
            ->first();

        if (!$ortuScanned) {
            return response()->json([
                'success' => false,
                'matched' => false,
                'message' => 'Kode QR penjemput tidak terdaftar dalam database sistem.',
                'siswa' => [
                    'nama' => $siswa->nama,
                    'nama_ortu_sah' => $siswa->orangTua ? $siswa->orangTua->nama : '-',
                ]
            ], 404);
        }

        // Cek kesesuaian orang tua penjemput dengan orang tua terdaftar siswa
        $isMatch = ($siswa->id_ortu_wali && $siswa->id_ortu_wali == $ortuScanned->id_ortu_wali);

        if (!$isMatch) {
            return response()->json([
                'success' => true,
                'matched' => false,
                'message' => 'QR Code penjemput TIDAK COCOK dengan orang tua / wali terdaftar!',
                'penjemput' => [
                    'nama' => $ortuScanned->nama,
                    'no_telp' => $ortuScanned->no_telp,
                ],
                'siswa' => [
                    'nama' => $siswa->nama,
                    'nama_ortu_sah' => $siswa->orangTua ? $siswa->orangTua->nama : 'Belum Ditentukan',
                ]
            ]);
        }

        // Verifikasi Sukses dan Cocok
        return response()->json([
            'success' => true,
            'matched' => true,
            'message' => 'Verifikasi berhasil! Penjemput cocok dan terverifikasi.',
            'penjemput' => [
                'id_ortu_wali' => $ortuScanned->id_ortu_wali,
                'nama' => $ortuScanned->nama,
                'no_telp' => $ortuScanned->no_telp,
            ],
            'siswa' => [
                'id_siswa' => $siswa->id_siswa,
                'nama' => $siswa->nama,
            ]
        ]);
    }

    /**
     * Konfirmasi & Simpan Riwayat Penjemputan
     */
    public function simpanPenjemputan(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'id_ortu_wali' => 'required|exists:orang_tua_wali,id_ortu_wali',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $penjemputan = Penjemputan::create([
            'id_user' => Auth::id() ?? 1,
            'id_siswa' => $request->id_siswa,
            'id_ortu_wali' => $request->id_ortu_wali,
            'waktu' => now(),
            'keterangan' => $request->keterangan ?: 'Dijemput oleh orang tua/wali',
            'status' => 'selesai',
        ]);

        $penjemputan->load(['siswa', 'orangTua']);

        return response()->json([
            'success' => true,
            'message' => 'Penjemputan ' . ($penjemputan->siswa->nama ?? 'Siswa') . ' berhasil dicatat!',
            'data' => [
                'id_penjemputan' => $penjemputan->id_penjemputan,
                'nama_siswa' => $penjemputan->siswa->nama ?? 'Siswa',
                'nama_ortu' => $penjemputan->orangTua->nama ?? 'Orang Tua / Wali',
                'waktu' => $penjemputan->waktu->format('H:i') . ' WIB',
                'keterangan' => $penjemputan->keterangan,
            ]
        ]);
    }
}

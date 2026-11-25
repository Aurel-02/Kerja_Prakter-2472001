<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;
use App\Models\Penjemputan;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjemputanController extends Controller
{
    /**
     * Tampilkan halaman Scan QR Penjemputan
     */
    public function scanQr()
    {
        $menungguPenjemputan = Penjemputan::with(['siswa', 'orangTua'])
            ->whereDate('waktu', today())
            ->where('status', 'menunggu')
            ->orderBy('waktu', 'desc')
            ->get();

        $riwayatHariIni = Penjemputan::with(['siswa', 'orangTua'])
            ->whereDate('waktu', today())
            ->where('status', 'selesai')
            ->orderBy('waktu', 'desc')
            ->take(25)
            ->get();

        $bulanIndo = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $now = Carbon::now();
        $tanggalHariIni = $now->format('d') . ' ' . $bulanIndo[(int) $now->format('n')] . ' ' . $now->format('Y');

        return view('guru.scan', compact('menungguPenjemputan', 'riwayatHariIni', 'tanggalHariIni'));
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

        // Cek apakah siswa sudah absen pulang (menunggu jemputan) hari ini
        $sedangMenunggu = Penjemputan::where('id_siswa', $siswa->id_siswa)
            ->whereDate('waktu', today())
            ->where('status', 'menunggu')
            ->latest('waktu')
            ->first();

        // Cek apakah siswa sudah selesai dijemput hari ini
        $sudahDijemput = Penjemputan::where('id_siswa', $siswa->id_siswa)
            ->whereDate('waktu', today())
            ->where('status', 'selesai')
            ->latest('waktu')
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil di-scan! Nama Siswa: ' . $siswa->nama,
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
            'sedang_menunggu' => $sedangMenunggu ? [
                'id_penjemputan' => $sedangMenunggu->id_penjemputan,
                'waktu' => $sedangMenunggu->waktu->format('H:i') . ' WIB',
            ] : null,
            'sudah_dijemput' => $sudahDijemput ? [
                'waktu' => $sudahDijemput->waktu->format('H:i') . ' WIB',
                'keterangan' => $sudahDijemput->keterangan,
            ] : null,
        ]);
    }

    /**
     * Simpan status Absen Pulang Siswa Dulu (Status: menunggu penjemput)
     */
    public function absenPulangSiswa(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
        ]);

        $siswa = Siswa::with('orangTua')->findOrFail($request->id_siswa);

        if (!$siswa->id_ortu_wali) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa "' . $siswa->nama . '" belum memiliki data Orang Tua / Wali yang terhubung.'
            ], 422);
        }

        // Cek apakah sudah ada dalam daftar tunggu hari ini
        $existing = Penjemputan::where('id_siswa', $siswa->id_siswa)
            ->whereDate('waktu', today())
            ->where('status', 'menunggu')
            ->first();

        if ($existing) {
            return response()->json([
                'success' => true,
                'already_exists' => true,
                'message' => 'Siswa "' . $siswa->nama . '" sudah tercatat di daftar absen pulang.',
                'data' => [
                    'id_penjemputan' => $existing->id_penjemputan,
                    'id_siswa' => $siswa->id_siswa,
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis ?? '-',
                    'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                    'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
                    'id_ortu_wali' => $siswa->id_ortu_wali,
                    'nama_ortu' => $siswa->orangTua ? $siswa->orangTua->nama : '-',
                    'no_telp_ortu' => $siswa->orangTua ? $siswa->orangTua->no_telp : '-',
                    'waktu' => $existing->waktu->format('H:i') . ' WIB',
                ]
            ]);
        }

        $penjemputan = Penjemputan::create([
            'id_user' => Auth::id() ?? 1,
            'id_siswa' => $siswa->id_siswa,
            'id_ortu_wali' => $siswa->id_ortu_wali,
            'waktu' => now(),
            'keterangan' => 'Siswa sudah absen pulang, menunggu penjemput',
            'status' => 'menunggu',
        ]);

        return response()->json([
            'success' => true,
            'already_exists' => false,
            'message' => 'Absen pulang siswa "' . $siswa->nama . '" berhasil dicatat!',
            'data' => [
                'id_penjemputan' => $penjemputan->id_penjemputan,
                'id_siswa' => $siswa->id_siswa,
                'nama' => $siswa->nama,
                'nis' => $siswa->nis ?? '-',
                'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                'tahun_ajaran' => $siswa->tahun_ajaran ?? '-',
                'id_ortu_wali' => $siswa->id_ortu_wali,
                'nama_ortu' => $siswa->orangTua ? $siswa->orangTua->nama : '-',
                'no_telp_ortu' => $siswa->orangTua ? $siswa->orangTua->no_telp : '-',
                'waktu' => $penjemputan->waktu->format('H:i') . ' WIB',
            ]
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

        // Cek apakah siswa sudah ada dalam daftar tunggu hari ini
        $penjemputan = Penjemputan::where('id_siswa', $request->id_siswa)
            ->whereDate('waktu', today())
            ->where('status', 'menunggu')
            ->first();

        if ($penjemputan) {
            // Update data yang sudah absen pulang menjadi selesai
            $penjemputan->update([
                'id_user' => Auth::id() ?? 1,
                'id_ortu_wali' => $request->id_ortu_wali,
                'waktu' => now(),
                'keterangan' => $request->keterangan ?: 'Dijemput oleh orang tua/wali',
                'status' => 'selesai',
            ]);
        } else {
            // Buat data baru langsung selesai
            $penjemputan = Penjemputan::create([
                'id_user' => Auth::id() ?? 1,
                'id_siswa' => $request->id_siswa,
                'id_ortu_wali' => $request->id_ortu_wali,
                'waktu' => now(),
                'keterangan' => $request->keterangan ?: 'Dijemput oleh orang tua/wali',
                'status' => 'selesai',
            ]);
        }

        $penjemputan->load(['siswa', 'orangTua']);

        return response()->json([
            'success' => true,
            'message' => 'Penjemputan ' . ($penjemputan->siswa->nama ?? 'Siswa') . ' berhasil dicatat!',
            'data' => [
                'id_penjemputan' => $penjemputan->id_penjemputan,
                'id_siswa' => $penjemputan->id_siswa,
                'nama_siswa' => $penjemputan->siswa->nama ?? 'Siswa',
                'nama_ortu' => $penjemputan->orangTua->nama ?? 'Orang Tua / Wali',
                'waktu' => $penjemputan->waktu->format('H:i') . ' WIB',
                'keterangan' => $penjemputan->keterangan,
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Penjemputan;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Format tanggal ke Bahasa Indonesia (contoh: 25 November 2026)
     */
    private function formatTanggalIndo(string $tanggal): string
    {
        $bulanIndo = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $date = Carbon::parse($tanggal);
        return $date->format('d') . ' ' . $bulanIndo[(int) $date->format('n')] . ' ' . $date->format('Y');
    }

    /**
     * Tampilkan halaman Absensi Siswa (QR Code)
     */
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal', today()->toDateString());
        try {
            $tanggal = Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            $tanggal = today()->toDateString();
        }

        $tanggalFormatted = $this->formatTanggalIndo($tanggal);

        $siswaList = Siswa::orderBy('nama', 'asc')->get();
        $absensiMap = Absensi::whereDate('tanggal', $tanggal)
            ->get()
            ->keyBy('id_siswa');

        $totalSiswa      = $siswaList->count();
        $totalHadir      = $absensiMap->where('status', 'hadir')->count();
        $totalIzin       = $absensiMap->where('status', 'izin')->count();
        $totalSakit      = $absensiMap->where('status', 'sakit')->count();
        $totalAlpha      = $absensiMap->where('status', 'alpha')->count();
        $totalBelumAbsen = max(0, $totalSiswa - $absensiMap->count());

        return view('guru.absensi', compact(
            'siswaList',
            'absensiMap',
            'tanggal',
            'tanggalFormatted',
            'totalSiswa',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalAlpha',
            'totalBelumAbsen'
        ));
    }

    /**
     * Proses Scan QR Code untuk Absensi Hadir Siswa
     */
    public function scanQr(Request $request)
    {
        $kode    = trim($request->input('kode'));
        $tanggal = $request->input('tanggal', today()->toDateString());

        if (!$kode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode QR / NIS siswa tidak boleh kosong.'
            ], 400);
        }

        $siswa = Siswa::where('qr_code_siswa', $kode)
            ->orWhere('nis', $kode)
            ->orWhere('id_siswa', $kode)
            ->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa dengan kode "' . $kode . '" tidak ditemukan di sistem.'
            ], 404);
        }

        $existing = Absensi::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tanggal', $tanggal)
            ->first();

        if ($existing && $existing->status === 'hadir') {
            $jam = $existing->waktu_masuk ? Carbon::parse($existing->waktu_masuk)->format('H:i') . ' WIB' : '-';
            return response()->json([
                'success'        => true,
                'already_exists' => true,
                'message'        => 'Siswa "' . $siswa->nama . '" sudah tercatat hadir pada pukul ' . $jam . '.',
                'data'           => [
                    'id_absensi'    => $existing->id_absensi,
                    'id_siswa'      => $siswa->id_siswa,
                    'nama'          => $siswa->nama,
                    'nis'           => $siswa->nis ?? '-',
                    'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                    'waktu_masuk'   => $jam,
                    'status'        => 'hadir',
                    'keterangan'    => $existing->keterangan,
                ]
            ]);
        }

        $waktuSekarang = now()->format('H:i:s');
        $absensi = Absensi::updateOrCreate(
            [
                'id_siswa' => $siswa->id_siswa,
                'tanggal'  => $tanggal,
            ],
            [
                'id_user'     => Auth::id() ?? 1,
                'waktu_masuk' => $waktuSekarang,
                'status'      => 'hadir',
                'keterangan'  => 'Scan QR Hadir',
            ]
        );

        // Otomatis masukkan ke daftar penjemputan (menunggu) untuk hari ini
        if ($siswa->id_ortu_wali) {
            $sudahAdaPenjemputan = Penjemputan::where('id_siswa', $siswa->id_siswa)
                ->whereDate('waktu', $tanggal)
                ->exists();

            if (!$sudahAdaPenjemputan) {
                Penjemputan::create([
                    'id_user'      => Auth::id() ?? 1,
                    'id_siswa'     => $siswa->id_siswa,
                    'id_ortu_wali' => $siswa->id_ortu_wali,
                    'waktu'        => now(),
                    'keterangan'   => 'Hadir sekolah, siap dijemput',
                    'status'       => 'menunggu',
                ]);
            }
        }

        return response()->json([
            'success'        => true,
            'already_exists' => false,
            'message'        => 'Berhasil absen hadir! ' . $siswa->nama,
            'data'           => [
                'id_absensi'    => $absensi->id_absensi,
                'id_siswa'      => $siswa->id_siswa,
                'nama'          => $siswa->nama,
                'nis'           => $siswa->nis ?? '-',
                'jenis_kelamin' => $siswa->jenis_kelamin ?? '-',
                'waktu_masuk'   => Carbon::parse($waktuSekarang)->format('H:i') . ' WIB',
                'status'        => 'hadir',
                'keterangan'    => $absensi->keterangan,
            ]
        ]);
    }

    /**
     * Update Status Absensi Manual (Hadir / Izin / Sakit / Alpha)
     */
    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id_siswa'   => 'required|exists:siswa,id_siswa',
            'tanggal'    => 'required|date',
            'status'     => 'required|in:hadir,izin,sakit,alpha',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $waktuMasuk = $validated['status'] === 'hadir' ? now()->format('H:i:s') : null;

        $absensi = Absensi::updateOrCreate(
            [
                'id_siswa' => $validated['id_siswa'],
                'tanggal'  => $validated['tanggal'],
            ],
            [
                'id_user'     => Auth::id() ?? 1,
                'waktu_masuk' => $waktuMasuk,
                'status'      => $validated['status'],
                'keterangan'  => $validated['keterangan'] ?? ucfirst($validated['status']),
            ]
        );

        // Sinkronkan dengan daftar penjemputan hari tersebut
        $siswa = Siswa::find($validated['id_siswa']);
        if ($siswa && $siswa->id_ortu_wali) {
            if ($validated['status'] === 'hadir') {
                $exists = Penjemputan::where('id_siswa', $siswa->id_siswa)
                    ->whereDate('waktu', $validated['tanggal'])
                    ->exists();
                if (!$exists) {
                    Penjemputan::create([
                        'id_user'      => Auth::id() ?? 1,
                        'id_siswa'     => $siswa->id_siswa,
                        'id_ortu_wali' => $siswa->id_ortu_wali,
                        'waktu'        => now(),
                        'keterangan'   => 'Hadir sekolah, siap dijemput',
                        'status'       => 'menunggu',
                    ]);
                }
            } else {
                // Jika diubah ke izin/sakit/alpha, hapus dari antrian menunggu penjemputan
                Penjemputan::where('id_siswa', $siswa->id_siswa)
                    ->whereDate('waktu', $validated['tanggal'])
                    ->where('status', 'menunggu')
                    ->delete();
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status absensi berhasil diperbarui.',
                'data'    => $absensi
            ]);
        }

        return back()->with('success', 'Status absensi siswa berhasil diperbarui.');
    }
}

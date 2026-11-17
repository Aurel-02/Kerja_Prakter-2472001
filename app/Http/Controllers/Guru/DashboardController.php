<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use App\Models\Kurikulum;
use App\Models\Penjemputan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Dashboard Guru
     */
    public function index()
    {
        try {
            $totalSiswa = Siswa::count();
            $totalLakiLaki = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
            $totalPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();
            $totalKurikulum = Kurikulum::count();
            $kegiatanTerdekat = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->take(4)->get();
            $totalPenjemputanHariIni = Penjemputan::whereDate('waktu', today())->count();
        } catch (\Throwable $e) {
            $totalSiswa = 0;
            $totalLakiLaki = 0;
            $totalPerempuan = 0;
            $totalKurikulum = 0;
            $kegiatanTerdekat = collect();
            $totalPenjemputanHariIni = 0;
        }

        $user = Auth::user();

        return view('guru.dashboard', compact(
            'user',
            'totalSiswa',
            'totalLakiLaki',
            'totalPerempuan',
            'totalKurikulum',
            'kegiatanTerdekat',
            'totalPenjemputanHariIni'
        ));
    }
}

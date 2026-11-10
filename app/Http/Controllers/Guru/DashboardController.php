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
            $totalKurikulum = Kurikulum::count();
            $kegiatanTerdekat = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->take(4)->get();
            $totalPenjemputanHariIni = Penjemputan::whereDate('waktu', today())->count();
        } catch (\Throwable $e) {
            $totalSiswa = 0;
            $totalKurikulum = 0;
            $kegiatanTerdekat = collect();
            $totalPenjemputanHariIni = 0;
        }

        $user = Auth::user();

        return view('guru.dashboard', compact(
            'user',
            'totalSiswa',
            'totalKurikulum',
            'kegiatanTerdekat',
            'totalPenjemputanHariIni'
        ));
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KalenderAkademik;
use App\Models\Kurikulum;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\StrukturSekolah;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalSiswa = Siswa::count();
            $totalLakiLaki = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
            $totalPerempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();
            $totalGuru = StrukturSekolah::count();
            $totalGaleri = Galeri::count();
            $totalKalender = KalenderAkademik::count();
            $totalKurikulum = Kurikulum::count();
            $sekolah = Sekolah::first() ?? new Sekolah([
                'visi' => 'Belum diatur',
                'misi' => 'Belum diatur',
            ]);
        } catch (\Throwable $e) {
            $totalSiswa = 0;
            $totalLakiLaki = 0;
            $totalPerempuan = 0;
            $totalGuru = 0;
            $totalGaleri = 0;
            $totalKalender = 0;
            $totalKurikulum = 0;
            $sekolah = new Sekolah([
                'visi' => 'Koneksi database belum terhubung',
                'misi' => 'Silakan hubungkan database cloud di Vercel Environment Variables',
            ]);
        }

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalLakiLaki',
            'totalPerempuan',
            'totalGuru',
            'totalGaleri',
            'totalKalender',
            'totalKurikulum',
            'sekolah'
        ));
    }
}

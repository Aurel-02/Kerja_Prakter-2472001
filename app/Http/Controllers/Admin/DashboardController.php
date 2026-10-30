<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\KalenderAkademik;
use App\Models\Kurikulum;
use App\Models\Sekolah;
use App\Models\StrukturSekolah;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = StrukturSekolah::count();
        $totalGaleri = Galeri::count();
        $totalKalender = KalenderAkademik::count();
        $totalKurikulum = Kurikulum::count();
        $sekolah = Sekolah::first() ?? new Sekolah([
            'visi' => 'Belum diatur',
            'misi' => 'Belum diatur',
        ]);

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalGaleri',
            'totalKalender',
            'totalKurikulum',
            'sekolah'
        ));
    }
}


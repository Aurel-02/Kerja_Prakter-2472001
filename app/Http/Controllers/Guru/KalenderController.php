<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;

class KalenderController extends Controller
{
    /**
     * Menampilkan daftar kalender akademik (Hanya Lihat untuk Role Guru)
     */
    public function index()
    {
        $kalenderList = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();
        return view('guru.kalender', compact('kalenderList'));
    }
}

<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Tampilkan data seluruh murid / siswa untuk Guru
     */
    public function index()
    {
        $siswaList = Siswa::with('orangTua')
            ->orderBy('nama', 'asc')
            ->get();

        return view('guru.siswa', compact('siswaList'));
    }
}


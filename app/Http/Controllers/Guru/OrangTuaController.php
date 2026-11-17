<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\OrangTuaWali;

class OrangTuaController extends Controller
{
    /**
     * Tampilkan data orang tua / wali untuk Guru
     */
    public function index()
    {
        $orangTuaList = OrangTuaWali::with('siswa')
            ->orderBy('nama', 'asc')
            ->get();

        return view('guru.orang-tua', compact('orangTuaList'));
    }
}


<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    /**
     * Menampilkan daftar kurikulum pembelajaran (Hanya Lihat untuk Role Guru)
     */
    public function index()
    {
        $kurikulumList = Kurikulum::orderBy('id_kurikulum', 'asc')->get();
        return view('guru.kurikulum', compact('kurikulumList'));
    }
}

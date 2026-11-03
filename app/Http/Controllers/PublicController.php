<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\KalenderAkademik;
use App\Models\Kurikulum;
use App\Models\Sekolah;
use App\Models\StrukturSekolah;

class PublicController extends Controller
{
    public function home()
    {
        try {
            $sekolah = Sekolah::first();
            $guruList = StrukturSekolah::take(2)->get();
            $fasilitas = Galeri::where('kategori', 'like', '%Fasilitas%')->take(6)->get();
        } catch (\Throwable $e) {
            $sekolah = null;
            $guruList = collect();
            $fasilitas = collect();
        }

        return view('public.home', compact('sekolah', 'guruList', 'fasilitas'));
    }

    public function about()
    {
        try {
            $sekolah = Sekolah::first();
        } catch (\Throwable $e) {
            $sekolah = null;
        }

        return view('public.about', compact('sekolah'));
    }

    public function kurikulum()
    {
        try {
            $kurikulum = Kurikulum::all();
        } catch (\Throwable $e) {
            $kurikulum = collect();
        }

        return view('public.kurikulum', compact('kurikulum'));
    }

    public function teacher()
    {
        try {
            $kepalaSekolah = StrukturSekolah::where('jabatan', 'like', '%Kepala Sekolah%')->first();
            $guruList = StrukturSekolah::where('jabatan', 'not like', '%Kepala Sekolah%')->get();

            if (! $kepalaSekolah && $guruList->isEmpty()) {
                $guruList = StrukturSekolah::all();
            }
        } catch (\Throwable $e) {
            $kepalaSekolah = null;
            $guruList = collect();
        }

        return view('public.teacher', compact('kepalaSekolah', 'guruList'));
    }

    public function vehicle()
    {
        try {
            $fasilitas = Galeri::where('kategori', 'like', '%Fasilitas%')->get();
            if ($fasilitas->isEmpty()) {
                $fasilitas = Galeri::all();
            }
        } catch (\Throwable $e) {
            $fasilitas = collect();
        }

        return view('public.vehicle', compact('fasilitas'));
    }

    public function contact()
    {
        try {
            $sekolah = Sekolah::first();
        } catch (\Throwable $e) {
            $sekolah = null;
        }

        return view('public.contact', compact('sekolah'));
    }

    public function sendContact()
    {
        return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!');
    }

    public function kalender()
    {
        try {
            $kalenderList = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();

            $kalenderSem1 = $kalenderList->filter(function ($item) {
                $bulan = \Carbon\Carbon::parse($item->tanggal_mulai)->month;

                return in_array($bulan, [7, 8, 9, 10, 11, 12]) || str_contains($item->kategori ?? '', 'Semester 1');
            });

            $kalenderSem2 = $kalenderList->filter(function ($item) {
                $bulan = \Carbon\Carbon::parse($item->tanggal_mulai)->month;

                return in_array($bulan, [1, 2, 3, 4, 5, 6]) || str_contains($item->kategori ?? '', 'Semester 2');
            });
        } catch (\Throwable $e) {
            $kalenderList = collect();
            $kalenderSem1 = collect();
            $kalenderSem2 = collect();
        }

        return view('public.kalender', compact('kalenderList', 'kalenderSem1', 'kalenderSem2'));
    }

    public function galeri()
    {
        try {
            $galeriList = Galeri::latest()->get();
        } catch (\Throwable $e) {
            $galeriList = collect();
        }

        return view('public.galeri', compact('galeriList'));
    }
}

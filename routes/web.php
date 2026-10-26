<?php

use Illuminate\Support\Facades\Route;

// Public Page Routes
Route::get('/', fn () => view('public.home'))->name('home');
Route::get('/about', fn () => view('public.about'))->name('about');
Route::get('/kurikulum', fn () => view('public.kurikulum'))->name('kurikulum');
Route::get('/teacher', fn () => view('public.teacher'))->name('teacher');
Route::get('/vehicle', fn () => view('public.vehicle'))->name('vehicle');
Route::get('/contact', fn () => view('public.contact'))->name('contact');
Route::post('/contact', fn () => redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!'))->name('contact.send');
Route::get('/kalender', fn () => view('public.kalender'))->name('kalender');
Route::get('/galeri', fn () => view('public.galeri'))->name('galeri');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
    Route::get('/guru', fn () => view('admin.guru'))->name('guru');
    Route::get('/siswa', fn () => view('admin.siswa'))->name('siswa');
    Route::get('/galeri', fn () => view('admin.galeri'))->name('galeri');
    Route::get('/kalender', fn () => view('admin.kalender'))->name('kalender');
});

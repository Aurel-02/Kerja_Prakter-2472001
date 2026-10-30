<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KalenderController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\SekolahController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public Page Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/kurikulum', [PublicController::class, 'kurikulum'])->name('kurikulum');
Route::get('/teacher', [PublicController::class, 'teacher'])->name('teacher');
Route::get('/vehicle', [PublicController::class, 'vehicle'])->name('vehicle');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'sendContact'])->name('contact.send');
Route::get('/kalender', [PublicController::class, 'kalender'])->name('kalender');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');

// Admin Routes (Tanpa Auth/Login dulu sesuai permintaan)
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Profil Sekolah
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/sekolah', [SekolahController::class, 'update'])->name('sekolah.update');

    // CRUD Struktur Sekolah / Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::put('/guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // Siswa (Menu statis yang sudah ada)
    Route::get('/siswa', fn () => view('admin.siswa'))->name('siswa');

    // CRUD Kalender Akademik
    Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender');
    Route::post('/kalender', [KalenderController::class, 'store'])->name('kalender.store');
    Route::put('/kalender/{id}', [KalenderController::class, 'update'])->name('kalender.update');
    Route::delete('/kalender/{id}', [KalenderController::class, 'destroy'])->name('kalender.destroy');

    // CRUD Galeri Foto
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // CRUD Kurikulum
    Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum');
    Route::post('/kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
    Route::put('/kurikulum/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');
    Route::delete('/kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');
});

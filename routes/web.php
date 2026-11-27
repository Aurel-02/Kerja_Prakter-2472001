<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KalenderController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\OrangTuaController;
use App\Http\Controllers\Admin\SekolahController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\OrangTuaController as GuruOrangTuaController;
use App\Http\Controllers\Guru\PenjemputanController as GuruPenjemputanController;
use App\Http\Controllers\Guru\SiswaController as GuruSiswaController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Auth Routes (Login & Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// Public Page Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/kurikulum', [PublicController::class, 'kurikulum'])->name('kurikulum');
Route::get('/teacher', [PublicController::class, 'teacher'])->name('teacher');
Route::get('/vehicle', [PublicController::class, 'vehicle'])->name('vehicle');
Route::redirect('/contact', '/')->name('contact');
Route::get('/kalender', [PublicController::class, 'kalender'])->name('kalender');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');

// Admin Routes (Dilindungi Auth & Admin Role Middleware - Hanya Admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard & Profil Sekolah
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');
    Route::put('/sekolah', [SekolahController::class, 'update'])->name('sekolah.update');

    // Kelola Akun Pengguna (Hanya Admin)
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // CRUD Struktur Sekolah / Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::put('/guru/{nip}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/{nip}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // CRUD Data Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    // Data Orang Tua / Wali
    Route::get('/orang-tua', [OrangTuaController::class, 'index'])->name('orang-tua');
    Route::post('/orang-tua', [OrangTuaController::class, 'store'])->name('orang-tua.store');
    Route::put('/orang-tua/{id}', [OrangTuaController::class, 'update'])->name('orang-tua.update');
    Route::delete('/orang-tua/{id}', [OrangTuaController::class, 'destroy'])->name('orang-tua.destroy');

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

    // Scan QR Penjemputan (Dapat diakses oleh Admin)
    Route::get('/scan-qr', [GuruPenjemputanController::class, 'scanQr'])->name('scan-qr');
    Route::post('/scan-qr/cek-siswa', [GuruPenjemputanController::class, 'cekSiswa'])->name('scan-qr.cek-siswa');
    Route::post('/scan-qr/absen-siswa', [GuruPenjemputanController::class, 'absenPulangSiswa'])->name('scan-qr.absen-siswa');
    Route::post('/scan-qr/cek-ortu', [GuruPenjemputanController::class, 'cekOrtu'])->name('scan-qr.cek-ortu');
    Route::post('/scan-qr/simpan', [GuruPenjemputanController::class, 'simpanPenjemputan'])->name('scan-qr.simpan');

    // Absensi Siswa QR (Dapat diakses oleh Admin)
    Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi');
    Route::post('/absensi/scan', [GuruAbsensiController::class, 'scanQr'])->name('absensi.scan');
    Route::post('/absensi/status', [GuruAbsensiController::class, 'updateStatus'])->name('absensi.status');
});

// Guru Routes (Dilindungi Auth Middleware)
Route::prefix('guru')->name('guru.')->middleware('auth')->group(function () {
    Route::get('/', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/scan-qr', [GuruPenjemputanController::class, 'scanQr'])->name('scan-qr');
    Route::post('/scan-qr/cek-siswa', [GuruPenjemputanController::class, 'cekSiswa'])->name('scan-qr.cek-siswa');
    Route::post('/scan-qr/absen-siswa', [GuruPenjemputanController::class, 'absenPulangSiswa'])->name('scan-qr.absen-siswa');
    Route::post('/scan-qr/cek-ortu', [GuruPenjemputanController::class, 'cekOrtu'])->name('scan-qr.cek-ortu');
    Route::post('/scan-qr/simpan', [GuruPenjemputanController::class, 'simpanPenjemputan'])->name('scan-qr.simpan');

    // Absensi Siswa QR untuk Guru
    Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi');
    Route::post('/absensi/scan', [GuruAbsensiController::class, 'scanQr'])->name('absensi.scan');
    Route::post('/absensi/status', [GuruAbsensiController::class, 'updateStatus'])->name('absensi.status');

    // Data Siswa & Orang Tua untuk Guru
    Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('siswa');
    Route::get('/orang-tua', [GuruOrangTuaController::class, 'index'])->name('orang-tua');
});

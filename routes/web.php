<?php

use Illuminate\Support\Facades\Route;

// Adward Template Routes
Route::get('/', fn() => view('adward.home'))->name('home');
Route::get('/about', fn() => view('adward.about'))->name('about');
Route::get('/teacher', fn() => view('adward.teacher'))->name('teacher');
Route::get('/vehicle', fn() => view('adward.vehicle'))->name('vehicle');
Route::get('/contact', fn() => view('adward.contact'))->name('contact');
Route::post('/contact', fn() => redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!'))->name('contact.send');

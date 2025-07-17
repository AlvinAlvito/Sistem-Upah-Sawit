<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\RiwayatKerjaController;

// =============================
// AUTH ROUTES
// =============================

// Login page
Route::view('/', 'login')->name('login');

// Proses login
Route::post('/', function (Request $request) {
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('pegawai.index');
    }

    return back()->with('error', 'Username atau password salah.');
})->name('login.proses');

// Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');


// =============================
// ADMIN ROUTES (Proteksi auth)
// =============================


Route::view('/admin', 'admin.index')->name('dashboard');

// Pegawai
Route::get('/admin/data-pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/admin/data-pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::delete('/admin/data-pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');


// Pemasukan
Route::get('/admin/data-pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
Route::post('/admin/data-pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');
Route::delete('/admin/data-pemasukan/{id}', [PemasukanController::class, 'destroy'])->name('pemasukan.destroy');


// Fuzzifikasi
Route::view('/admin/fuzzifikasi', 'admin.fuzzifikasi')->name('fuzzifikasi');

// Riwayat Gaji & Bonus
Route::get('/admin/gaji-bonus', [RiwayatKerjaController::class, 'index'])->name('riwayat.index');
Route::get('/admin/gaji-bonus/create', [RiwayatKerjaController::class, 'create'])->name('riwayat.create');
Route::post('/admin/gaji-bonus', [RiwayatKerjaController::class, 'store'])->name('riwayat.store');

<?php

use App\Http\Controllers\Api\ChartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\FuzzyfikasiController;
use App\Http\Controllers\RiwayatKerjaController;
use App\Http\Controllers\GajiController;

// ===================
// Halaman Login
// ===================
Route::get('/', function () {
    return view('login');
})->name('login');

// ===================
// Proses Login Manual
// ===================
Route::post('/', function (Request $request) {
    $username = $request->username;
    $password = $request->password;

    if ($username === 'admin' && $password === '123') {
        session(['is_admin' => true]);
        return redirect('/admin');
    }

    return back()->withErrors(['login' => 'Username atau Password salah!']);
})->name('login.proses');

// ===================
// Logout
// ===================
Route::get('/logout', function () {
    session()->forget('is_admin');
    return redirect('/');
})->name('logout');

// ===================
// Dashboard Admin
// ===================
Route::get('/admin', function () {
    if (!session('is_admin')) {
        return redirect('/');
    }
    return view('admin.index');
})->name('dashboard');

// ===================
// CRUD Pegawai
// ===================
Route::get('/admin/data-pegawai', function () {
    if (!session('is_admin')) return redirect('/');
    return app(PegawaiController::class)->index();
})->name('pegawai.index');

Route::post('/admin/data-pegawai', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(PegawaiController::class)->store($request);
})->name('pegawai.store');

Route::delete('/admin/data-pegawai/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(PegawaiController::class)->destroy($id);
})->name('pegawai.destroy');

// ===================
// CRUD Pemasukan
// ===================
Route::get('/admin/data-pemasukan', function () {
    if (!session('is_admin')) return redirect('/');
    return app(PemasukanController::class)->index();
})->name('pemasukan.index');

Route::post('/admin/data-pemasukan', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(PemasukanController::class)->store($request);
})->name('pemasukan.store');

Route::delete('/admin/data-pemasukan/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(PemasukanController::class)->destroy($id);
})->name('pemasukan.destroy');

// ===================
// Fuzzifikasi
// ===================
Route::get('/admin/fuzzifikasi', function () {
    if (!session('is_admin')) return redirect('/');
    return app(FuzzyfikasiController::class)->index();
})->name('fuzzifikasi');

// ===================
// Riwayat Gaji & Bonus
// ===================
Route::get('/admin/gaji-bonus', function () {
    if (!session('is_admin')) return redirect('/');
    return app(GajiController::class)->index();
})->name('admin.gaji');
Route::get('/admin/gaji/download', [GajiController::class, 'downloadPDF'])->name('gaji.download');


Route::get('/chart/sektor', [ChartController::class, 'buahPerSektor']);
Route::get('/chart/pegawai', [ChartController::class, 'buahPerPegawai']);
Route::get('/chart/cuaca', [ChartController::class, 'buahPerCuaca']);
Route::get('/chart/pendapatan-tertinggi', [ChartController::class, 'pendapatanTertinggi']);
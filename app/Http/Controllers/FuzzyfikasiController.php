<?php

namespace App\Http\Controllers;

use App\Models\Fuzzyfikasi;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class FuzzyfikasiController extends Controller
{
    public function index()
    {
        // Ambil semua data fuzzyfikasi dengan relasi ke pegawai
        $fuzzifikasi = Fuzzyfikasi::with('pegawai')->get();

        return view('admin.fuzzifikasi', compact('fuzzifikasi'));
    }

    public function store(Request $request)
    {
        $pemasukan = new Pemasukan();
        $pemasukan->nama = $request->nama;
        $pemasukan->akademik = $request->akademik;
        $pemasukan->minat = $request->minat;
        $pemasukan->bakat = $request->bakat;
        $pemasukan->gaya_belajar = $request->gaya_belajar;
        $pemasukan->save();

        // Memanggil proses fuzzifikasi yang ada di Model pemasukan
        $pemasukan->prosesFuzzifikasi();

        return redirect()->route('admin.fuzzifikasi')->with('success', 'Data berhasil ditambahkan dan difuzzifikasi.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKerja;
use App\Models\Pegawai;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class RiwayatKerjaController extends Controller
{
    // Halaman daftar riwayat kerja
    public function index()
    {
        $riwayats = RiwayatKerja::with('pegawai')->latest()->get();
        return view('admin.gaji-bonus', compact('riwayats'));
    }

    // Halaman form input penggajian berdasarkan data pemasukan
    public function create()
    {
        $pegawais = Pegawai::all();

        // Menampilkan data pemasukan yang belum diproses ke dalam riwayat kerja
        $pemasukans = Pemasukan::with('pegawai')->get();

        return view('admin.input-kerja', compact('pegawais', 'pemasukans'));
    }

    // Proses simpan data gaji dan bonus
    public function store(Request $request)
    {
        $request->validate([
            'pemasukan_id' => 'required|exists:pemasukans,id',
        ]);

        $pemasukan = Pemasukan::with('pegawai')->findOrFail($request->pemasukan_id);

        // Hitung gaji pokok (30 perak per Kg)
        $gaji = $pemasukan->jumlah_buah * 30;

        // Dummy proses fuzzy bonus — nanti diganti Mamdani
        $bonusPersen = $this->hitungBonusFuzzy($pemasukan);
        $bonus = $gaji * $bonusPersen;
        $total = $gaji + $bonus;

        // Simpan ke tabel riwayat kerja
        RiwayatKerja::create([
            'pegawai_id' => $pemasukan->pegawai_id,
            'gaji_pokok' => $gaji,
            'bonus_nominal' => $bonus,
            'total_upah' => $total,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Gaji dan bonus berhasil dihitung dan disimpan!');
    }

    // Dummy fuzzy Mamdani — bisa diganti nanti
    protected function hitungBonusFuzzy(Pemasukan $pemasukan)
    {
        $sektor = $pemasukan->sektor;
        $cuaca = $pemasukan->cuaca;

        // Contoh logika kasar sementara
        if ($sektor === 'Sektor Selatan' && $cuaca === 'Hujan') {
            return 0.20; // Sangat Tinggi
        } elseif ($sektor === 'Sektor Barat') {
            return 0.15; // Tinggi
        } elseif ($sektor === 'Sektor Timur') {
            return 0.10;
        } else {
            return 0.05; // Rendah
        }
    }
}

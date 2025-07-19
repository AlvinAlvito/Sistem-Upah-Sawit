<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::with('pegawai')->latest()->get();
        $pegawais = Pegawai::all();

        return view('admin.data-pemasukan', compact('pemasukan', 'pegawais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'sektor' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'jumlah_buah' => 'required|numeric|min:1',
            'jarak_lokasi' => 'required|numeric|min:0|max:5',
            'cuaca' => 'required|numeric|min:0|max:20',
            'kondisi_jalan' => 'required|numeric|min:0|max:20'
        ]);

        $pemasukan = Pemasukan::create($validated);
        $pemasukan->prosesFuzzifikasi();

        return redirect()->back()->with('success', 'Data pemasukan berhasil ditambahkan dan difuzzifikasi!');
    }



    public function destroy($id)
    {
        Pemasukan::destroy($id);
        return redirect()->back()->with('success', 'Data pemasukan berhasil dihapus!');
    }
}

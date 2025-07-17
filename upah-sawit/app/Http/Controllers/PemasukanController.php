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
            'cuaca' => 'required|string|max:100'
        ]);

        Pemasukan::create($validated);
        return redirect()->back()->with('success', 'Data pemasukan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        Pemasukan::destroy($id);
        return redirect()->back()->with('success', 'Data pemasukan berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.data-pegawai', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'umur' => 'required|integer|min:17|max:100',
            'alamat' => 'nullable|string|max:255',
        ]);

        Pegawai::updateOrCreate(
            ['id' => $request->id], // jika ada ID, update. Jika tidak, insert baru.
            $validated
        );

        $message = $request->id ? 'Pegawai berhasil diperbarui!' : 'Pegawai berhasil ditambahkan!';
        return redirect()->route('pegawai.index')->with('success', $message);
    }

    public function destroy($id)
    {
        Pegawai::destroy($id);
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus!');
    }
}

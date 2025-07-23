<?php

namespace App\Http\Controllers;

use App\Models\RiwayatKerja;
use App\Models\Pegawai;

class GajiController extends Controller
{
    public function index()
    {
        $data = RiwayatKerja::with('pegawai')->get();

        return view('admin.gaji', compact('data'));
    }
}

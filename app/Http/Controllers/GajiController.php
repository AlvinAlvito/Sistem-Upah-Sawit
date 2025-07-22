<?php

namespace App\Http\Controllers;

use App\Models\HasilFuzzy;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $data = HasilFuzzy::with('pegawai', 'pemasukan')->get()->map(function ($item) {
            $jumlah_buah = $item->pemasukan->jumlah_buah ?? 0;
            $gaji_pokok = $jumlah_buah * 300;

            // Perbaikan: field yg benar 'persentase'
            $bonus = round(($item->persentase ?? 0) * 1000); 

            $total = $gaji_pokok + $bonus;

            return (object)[
                'pegawai' => $item->pegawai,
                'gaji_pokok' => $gaji_pokok,
                'bonus' => $bonus,
                'total' => $total,
            ];
        });

        return view('admin.gaji', compact('data'));
    }
}

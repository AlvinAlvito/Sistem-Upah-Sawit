<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKerja;
use PDF; // pastikan composer require dompdf/dompdf sudah dilakukan

class GajiController extends Controller
{
    public function index()
    {
        $data = RiwayatKerja::with('pegawai')->get();
        return view('admin.gaji', compact('data'));
    }

    public function downloadPDF()
    {
        $data = RiwayatKerja::with('pegawai')->get();
        $pdf = PDF::loadView('admin.gaji_pdf', compact('data'));
        return $pdf->download('laporan-gaji-pegawai.pdf');
    }
}

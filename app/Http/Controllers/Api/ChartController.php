<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Jumlah buah berdasarkan sektor
        $buahPerSektor = Pemasukan::select('sektor', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('sektor')
            ->pluck('total', 'sektor');

        // ✅ FIXED: Jumlah buah per pegawai menggunakan JOIN langsung
        $buahPerPegawai = DB::table('pemasukans')
            ->join('pegawais', 'pemasukans.pegawai_id', '=', 'pegawais.id')
            ->select('pegawais.nama', DB::raw('SUM(pemasukans.jumlah_buah) as total'))
            ->groupBy('pegawais.nama')
            ->get();

        $pegawaiLabels = $buahPerPegawai->pluck('nama');
        $pegawaiData = $buahPerPegawai->pluck('total');

        // Jumlah buah berdasarkan cuaca
        $buahPerCuaca = Pemasukan::select('cuaca', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('cuaca')
            ->pluck('total', 'cuaca');

        // Top 5 pendapatan pegawai
        $topPendapatan = DB::table('riwayat_kerjas')
            ->join('pegawais', 'riwayat_kerjas.pegawai_id', '=', 'pegawais.id')
            ->select('pegawais.nama', DB::raw('SUM(riwayat_kerjas.total_upah) as total'))
            ->groupBy('riwayat_kerjas.pegawai_id', 'pegawais.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'buahPerSektor',
            'buahPerCuaca',
            'topPendapatan',
            'pegawaiLabels',
            'pegawaiData'
        ));
    }
}

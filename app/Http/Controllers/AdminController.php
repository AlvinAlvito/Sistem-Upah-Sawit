<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function buahPerSektor()
    {
        $data = Pemasukan::select('sektor', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('sektor')
            ->get();

        return response()->json([
            'labels' => $data->pluck('sektor'),
            'data' => $data->pluck('total'),
        ]);
    }

    public function buahPerPegawai()
    {
        $data = DB::table('pemasukans')
            ->join('pegawais', 'pemasukans.pegawai_id', '=', 'pegawais.id')
            ->select('pegawais.nama', DB::raw('SUM(pemasukans.jumlah_buah) as total'))
            ->groupBy('pegawais.nama')
            ->get();

        return response()->json([
            'labels' => $data->pluck('nama'),
            'data' => $data->pluck('total'),
        ]);
    }

    public function buahPerCuaca()
    {
        $data = Pemasukan::select('cuaca', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('cuaca')
            ->get();

        return response()->json([
            'labels' => $data->pluck('cuaca'),
            'data' => $data->pluck('total'),
        ]);
    }

    public function pendapatanTertinggi()
    {
        $data = DB::table('riwayat_kerjas')
            ->join('pegawais', 'riwayat_kerjas.pegawai_id', '=', 'pegawais.id')
            ->select('pegawais.nama', DB::raw('SUM(riwayat_kerjas.total_upah) as total'))
            ->groupBy('riwayat_kerjas.pegawai_id', 'pegawais.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return response()->json([
            'labels' => $data->pluck('nama'),
            'data' => $data->pluck('total'),
        ]);
    }
}

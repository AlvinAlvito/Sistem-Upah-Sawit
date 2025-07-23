<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\RiwayatKerja;
use App\Models\User;
use DB;

class ChartController extends Controller
{
    public function buahPerSektor()
    {
        $result = Pemasukan::select('sektor', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('sektor')
            ->get();

        return response()->json([
            'labels' => $result->pluck('sektor'),
            'data' => $result->pluck('total')
        ]);
    }

    public function buahPerPegawai()
    {
        $result = Pemasukan::with('pegawai')
            ->select('pegawai_id', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('pegawai_id')
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->pegawai->name ?? 'Unknown',
                    'total' => $item->total
                ];
            });

        return response()->json([
            'labels' => $result->pluck('nama'),
            'data' => $result->pluck('total')
        ]);
    }

    public function buahPerCuaca()
    {
        $result = Pemasukan::select('cuaca', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('cuaca')
            ->get();

        return response()->json([
            'labels' => $result->pluck('cuaca'),
            'data' => $result->pluck('total')
        ]);
    }

    public function pendapatanTertinggi()
    {
        $result = RiwayatKerja::with('pegawai')
            ->select('pegawai_id', DB::raw('SUM(total_upah) as total'))
            ->groupBy('pegawai_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->pegawai->name ?? 'Unknown',
                    'total' => $item->total
                ];
            });

        return response()->json([
            'labels' => $result->pluck('nama'),
            'data' => $result->pluck('total')
        ]);
    }
}

<?php
use App\Models\Pemasukan;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


    public function index()
    {
        // Jumlah buah berdasarkan sektor
        $buahPerSektor = Pemasukan::select('sektor', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('sektor')
            ->pluck('total', 'sektor');

        // Jumlah buah berdasarkan pegawai
        $buahPerPegawai = Pemasukan::with('pegawai')
            ->select('pegawai_id', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('pegawai_id')
            ->get()
            ->pluck('total', fn($item) => $item->pegawai->nama ?? 'Tidak diketahui');

        // Jumlah buah berdasarkan cuaca
        $buahPerCuaca = Pemasukan::select('cuaca', DB::raw('SUM(jumlah_buah) as total'))
            ->groupBy('cuaca')
            ->pluck('total', 'cuaca');

        // Total pendapatan 5 pegawai tertinggi
        $topPendapatan = DB::table('riwayat_kerjas')
            ->join('pegawais', 'riwayat_kerjas.pegawai_id', '=', 'pegawais.id')
            ->select('pegawais.nama', DB::raw('SUM(riwayat_kerjas.total_upah) as total'))
            ->groupBy('riwayat_kerjas.pegawai_id', 'pegawais.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.index', compact(
            'buahPerSektor',
            'buahPerPegawai',
            'buahPerCuaca',
            'topPendapatan'
        ));
    }
}
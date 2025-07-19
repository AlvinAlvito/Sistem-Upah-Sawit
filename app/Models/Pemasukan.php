<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = ['pegawai_id', 'sektor', 'tanggal', 'jarak_lokasi', 'jumlah_buah', 'cuaca', 'kondisi_jalan'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function tampilkanCuaca()
    {
        if ($this->cuaca <= 4) {
            return 'Hujan';
        } elseif ($this->cuaca <= 9) {
            return 'Mendung';
        } else {
            return 'Cerah';
        }
    }

    public function tampilkanKondisiJalan()
    {
        if ($this->kondisi_jalan <= 4) {
            return 'Buruk';
        } elseif ($this->kondisi_jalan <= 9) {
            return 'Sedang';
        } else {
            return 'Baik';
        }
    }

    // App\Models\Pemasukan.php

    public function prosesFuzzifikasi()
    {
        $fuzzy = \App\Models\Fuzzyfikasi::firstOrNew(['pegawai_id' => $this->pegawai_id]);

        // --- Konfigurasi Batas ---
        $batas = [
            'jumlah_buah' => [100, 300, 500],       
            'jarak' => [1, 3, 5],                  
            'cuaca' => [                          
                'hujan' => [0, 5, 10],
                'mendung' => [5, 10, 15],
                'cerah' => [10, 15, 20]
            ],
            'jalan' => [                           
                'buruk' => [0, 5, 10],
                'sedang' => [5, 10, 15],
                'baik' => [10, 15, 20]
            ]
        ];

        // --- FUZZIFIKASI JUMLAH BUAH ---
        $x = $this->jumlah_buah;
        [$low, $med, $high] = $batas['jumlah_buah'];
        $fuzzy->jumlah_rendah = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->jumlah_sedang = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->jumlah_banyak = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        // --- FUZZIFIKASI JARAK ---
        $x = $this->jarak_lokasi;
        [$low, $med, $high] = $batas['jarak'];
        $fuzzy->jarak_dekat = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->jarak_sedang = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->jarak_jauh = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        // --- FUZZIFIKASI CUACA ---
        $x = $this->cuaca;
        [$a, $b, $c] = $batas['cuaca']['hujan'];
        $fuzzy->cuaca_hujan = ($x <= $a) ? 1 : (($x <= $b) ? ($b - $x) / ($b - $a) : 0);
        [$a, $b, $c] = $batas['cuaca']['mendung'];
        $fuzzy->cuaca_mendung = ($x <= $a || $x >= $c) ? 0 : (($x <= $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b));
        [$a, $b, $c] = $batas['cuaca']['cerah'];
        $fuzzy->cuaca_cerah = ($x <= $b) ? 0 : (($x <= $c) ? ($x - $b) / ($c - $b) : 1);

        // --- FUZZIFIKASI JALAN ---
        $x = $this->kondisi_jalan;
        [$a, $b, $c] = $batas['jalan']['buruk'];
        $fuzzy->jalan_buruk = ($x <= $a) ? 1 : (($x <= $b) ? ($b - $x) / ($b - $a) : 0);
        [$a, $b, $c] = $batas['jalan']['sedang'];
        $fuzzy->jalan_sedang = ($x <= $a || $x >= $c) ? 0 : (($x <= $b) ? ($x - $a) / ($b - $a) : ($c - $x) / ($c - $b));
        [$a, $b, $c] = $batas['jalan']['baik'];
        $fuzzy->jalan_baikk = ($x <= $b) ? 0 : (($x <= $c) ? ($x - $b) / ($c - $b) : 1);

        $fuzzy->save();
    }




}

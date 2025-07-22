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
            'jumlah_buah' => [100, 300, 500],        // rendah, sedang, tinggi
            'jarak' => [2, 3, 4],                    // dekat, sedang, jauh
            'cuaca' => [15, 10, 5],                  // hujan, mendung, cerah (pakai angka representasi)
            'jalan' => [5, 10, 15],                  // buruk, sedang, baik (pakai angka representasi)
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
        $x = (float) $this->cuaca; // pastikan cuaca disimpan sebagai angka
        [$low, $med, $high] = $batas['cuaca'];
        $fuzzy->cuaca_hujan = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->cuaca_mendung = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->cuaca_cerah = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        // --- FUZZIFIKASI KONDISI JALAN ---
        $x = (float) $this->kondisi_jalan; // pastikan kondisi_jalan disimpan sebagai angka
        [$low, $med, $high] = $batas['jalan'];
        $fuzzy->jalan_buruk = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->jalan_sedang = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->jalan_baikk = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        $fuzzy->save();
    }





}

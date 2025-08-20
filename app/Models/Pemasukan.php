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
            return 'Cerah';
        } elseif ($this->cuaca <= 9) {
            return 'mendung';
        } else {
            return 'Hujan';
        }
    }

    public function tampilkanKondisiJalan()
    {
        if ($this->kondisi_jalan <= 4) {
            return 'Baik';
        } elseif ($this->kondisi_jalan <= 9) {
            return 'Sedang';
        } else {
            return 'Buruk';
        }
    }

    // App\Models\Pemasukan.php

    public function prosesFuzzifikasi()
    {
        $fuzzy = Fuzzyfikasi::firstOrNew([
            'pegawai_id' => $this->pegawai_id,
            'pemasukan_id' => $this->id
        ]);

        // --- Konfigurasi Batas ---
        $batas = [
            'jumlah_buah' => [50, 100, 200, 300, 400], // [rendah_min, rendah_max, sedang_peak, sedang_max, banyak_max]
            'jarak' => [1, 2, 3],                // [dekat_peak, sedang_peak, jauh_peak]
            'cuaca' => [5, 10, 15],              // [cerah_peak, gerimis_peak, hujan_peak]
            'jalan' => [5, 10, 15],              // [baik_peak, sedang_peak, buruk_peak]
        ];

        // --- FUZZIFIKASI JUMLAH BUAH ---
        $x = $this->jumlah_buah;
        [$lowMin, $lowMax, $peak, $medMax, $highMax] = $batas['jumlah_buah'];

        // Rendah
        if ($x <= $lowMin) {
            $fuzzy->jumlah_rendah = 1;
        } elseif ($x > $lowMin && $x < $lowMax) {
            $fuzzy->jumlah_rendah = ($lowMax - $x) / ($lowMax - $lowMin);
        } else {
            $fuzzy->jumlah_rendah = 0;
        }

        // Sedang
        if ($x > $lowMax && $x < $peak) {
            $fuzzy->jumlah_sedang = ($x - $lowMax) / ($peak - $lowMax);
        } elseif ($x == $peak) {
            $fuzzy->jumlah_sedang = 1;
        } elseif ($x > $peak && $x < $medMax) {
            $fuzzy->jumlah_sedang = ($medMax - $x) / ($medMax - $peak);
        } else {
            $fuzzy->jumlah_sedang = 0;
        }

        // Banyak
        if ($x > $medMax && $x < $highMax) {
            $fuzzy->jumlah_banyak = ($x - $medMax) / ($highMax - $medMax);
        } elseif ($x >= $highMax) {
            $fuzzy->jumlah_banyak = 1;
        } else {
            $fuzzy->jumlah_banyak = 0;
        }

        // --- FUZZIFIKASI JARAK ---
        $x = $this->jarak_lokasi;
        [$low, $med, $high] = $batas['jarak'];

        // Dekat
        if ($x <= $low) {
            $fuzzy->jarak_dekat = 1;
        } elseif ($x > $low && $x < $med) {
            $fuzzy->jarak_dekat = ($med - $x) / ($med - $low);
        } else {
            $fuzzy->jarak_dekat = 0;
        }

        // Sedang
        if ($x > $low && $x < $med) {
            $fuzzy->jarak_sedang = ($x - $low) / ($med - $low);
        } elseif ($x == $med) {
            $fuzzy->jarak_sedang = 1;
        } elseif ($x > $med && $x < $high) {
            $fuzzy->jarak_sedang = ($high - $x) / ($high - $med);
        } else {
            $fuzzy->jarak_sedang = 0;
        }

        // Jauh
        if ($x > $med && $x < $high) {
            $fuzzy->jarak_jauh = ($x - $med) / ($high - $med);
        } elseif ($x >= $high) {
            $fuzzy->jarak_jauh = 1;
        } else {
            $fuzzy->jarak_jauh = 0;
        }

        // --- FUZZIFIKASI CUACA ---
        $x = (float) $this->cuaca;
        [$low, $med, $high] = $batas['cuaca'];

        // Cerah
        if ($x <= $low) {
            $fuzzy->cuaca_cerah = 1;
        } elseif ($x > $low && $x < $med) {
            $fuzzy->cuaca_cerah = ($med - $x) / ($med - $low);
        } else {
            $fuzzy->cuaca_cerah = 0;
        }

        // Gerimis
        if ($x > $low && $x < $med) {
            $fuzzy->cuaca_mendung = ($x - $low) / ($med - $low);
        } elseif ($x == $med) {
            $fuzzy->cuaca_mendung = 1;
        } elseif ($x > $med && $x < $high) {
            $fuzzy->cuaca_mendung = ($high - $x) / ($high - $med);
        } else {
            $fuzzy->cuaca_mendung = 0;
        }

        // Hujan
        if ($x > $med && $x < $high) {
            $fuzzy->cuaca_hujan = ($x - $med) / ($high - $med);
        } elseif ($x >= $high) {
            $fuzzy->cuaca_hujan = 1;
        } else {
            $fuzzy->cuaca_hujan = 0;
        }

        // --- FUZZIFIKASI KONDISI JALAN ---
        $x = (float) $this->kondisi_jalan;
        [$low, $med, $high] = $batas['jalan'];

        // Baik
        if ($x <= $low) {
            $fuzzy->jalan_baikk = 1;
        } elseif ($x > $low && $x < $med) {
            $fuzzy->jalan_baikk = ($med - $x) / ($med - $low);
        } else {
            $fuzzy->jalan_baikk = 0;
        }

        // Sedang
        if ($x > $low && $x < $med) {
            $fuzzy->jalan_sedang = ($x - $low) / ($med - $low);
        } elseif ($x == $med) {
            $fuzzy->jalan_sedang = 1;
        } elseif ($x > $med && $x < $high) {
            $fuzzy->jalan_sedang = ($high - $x) / ($high - $med);
        } else {
            $fuzzy->jalan_sedang = 0;
        }

        // Buruk
        if ($x > $med && $x < $high) {
            $fuzzy->jalan_buruk = ($x - $med) / ($high - $med);
        } elseif ($x >= $high) {
            $fuzzy->jalan_buruk = 1;
        } else {
            $fuzzy->jalan_buruk = 0;
        }

        $fuzzy->save();


        // === RULE BASE (Z skala manual) ===
        $rules = [
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 200], // No 1
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_sedang, $fuzzy->cuaca_cerah, $fuzzy->jalan_sedang), 'z' => 200], // No 2
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 300], // No 3
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 100], // No 4 (mendung = cuaca_mendung)
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 300], // No 5
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_hujan, $fuzzy->jalan_sedang), 'z' => 200], // No 6
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_sedang, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 100], // No 7
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_jauh, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 200], // No 8
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_jauh, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 100], // No 9
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 200], // No 10
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 300], // No 11
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_cerah, $fuzzy->jalan_buruk), 'z' => 200], // No 12
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_jauh, $fuzzy->cuaca_mendung, $fuzzy->jalan_buruk), 'z' => 300], // No 13
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_sedang, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 300], // No 14
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_sedang, $fuzzy->cuaca_cerah, $fuzzy->jalan_sedang), 'z' => 200], // No 15
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_hujan, $fuzzy->jalan_baikk), 'z' => 100], // No 16
        ];

        // === DEFUZZIFIKASI METODE CENTROID ===
        $totalAtas = 0;
        $totalBawah = 0;

        foreach ($rules as $rule) {
            if ($rule['nilai'] > 0) {
                $totalAtas += $rule['nilai'] * $rule['z'];
                $totalBawah += $rule['nilai'];
            }
        }

        // Hitung Z final
        if ($totalBawah > 0) {
            $z_final = $totalAtas / $totalBawah;
        } else {
            // fallback jika tidak ada rule aktif
            $z_final = 100;
        }

        // Bulatkan ke 3 level saja (100, 200, 300)
        if ($z_final < 150) {
            $z_final = 100;
        } elseif ($z_final < 250) {
            $z_final = 200;
        } else {
            $z_final = 300;
        }

        // Hitung persentase (33.33%, 66.66%, 99.99%)
        $persentase = round(($z_final / 300) * 100, 2);

        // Simpan hasil fuzzy
        $hasil = new HasilFuzzy();
        $hasil->pemasukan_id = $this->id;
        $hasil->pegawai_id = $this->pegawai_id;
        $hasil->nilai_z = $z_final;
        $hasil->persentase = $persentase;
        $hasil->save();

        // Hitung gaji pokok dan bonus
        $gaji_pokok = $this->jumlah_buah * 300;
        $bonus = round(($persentase / 100) * $gaji_pokok);
        $total = $gaji_pokok + $bonus;

        logger("JUMLAH BUAH: {$this->jumlah_buah}");
        logger("GAJI POKOK: {$gaji_pokok}");
        logger("PRESENTASE: {$persentase}");
        logger("BONUS: {$bonus}");
        logger("TOTAL: {$total}");

        \App\Models\RiwayatKerja::create([
            'pegawai_id' => $this->pegawai_id,
            'gaji_pokok' => $gaji_pokok,
            'bonus_nominal' => $bonus,
            'total_upah' => $total,
        ]);


    }









}

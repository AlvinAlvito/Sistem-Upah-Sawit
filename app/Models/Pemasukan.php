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
        $fuzzy = Fuzzyfikasi::firstOrNew([
            'pegawai_id' => $this->pegawai_id,
            'pemasukan_id' => $this->id
        ]);

        // --- Konfigurasi Batas ---
        $batas = [
            'jumlah_buah' => [100, 300, 500],  // rendah, sedang, tinggi
            'jarak' => [2, 3, 4],              // dekat, sedang, jauh
            'cuaca' => [5, 10, 15],            // hujan, mendung, cerah
            'jalan' => [5, 10, 15],            // buruk, sedang, baik
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
        $x = (float) $this->cuaca;
        [$low, $med, $high] = $batas['cuaca'];
        $fuzzy->cuaca_hujan = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->cuaca_mendung = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->cuaca_cerah = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        // --- FUZZIFIKASI KONDISI JALAN ---
        $x = (float) $this->kondisi_jalan;
        [$low, $med, $high] = $batas['jalan'];
        $fuzzy->jalan_buruk = ($x <= $low) ? 1 : (($x <= $med) ? ($med - $x) / ($med - $low) : 0);
        $fuzzy->jalan_sedang = ($x <= $low || $x >= $high) ? 0 : (($x <= $med) ? ($x - $low) / ($med - $low) : ($high - $x) / ($high - $med));
        $fuzzy->jalan_baikk = ($x <= $med) ? 0 : (($x <= $high) ? ($x - $med) / ($high - $med) : 1);

        $fuzzy->save();

        // === RULE BASE ===
        $rules = [
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 90],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_sedang, $fuzzy->cuaca_cerah, $fuzzy->jalan_sedang), 'z' => 85],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 40],
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 70],
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 30],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_hujan, $fuzzy->jalan_sedang), 'z' => 50],
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_sedang, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 45],
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_jauh, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 75],
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_jauh, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 55],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_dekat, $fuzzy->cuaca_mendung, $fuzzy->jalan_baikk), 'z' => 80],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_jauh, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 35],
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_cerah, $fuzzy->jalan_buruk), 'z' => 60],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_jauh, $fuzzy->cuaca_mendung, $fuzzy->jalan_buruk), 'z' => 45],
            ['nilai' => min($fuzzy->jumlah_banyak, $fuzzy->jarak_sedang, $fuzzy->cuaca_hujan, $fuzzy->jalan_buruk), 'z' => 50],
            ['nilai' => min($fuzzy->jumlah_rendah, $fuzzy->jarak_sedang, $fuzzy->cuaca_cerah, $fuzzy->jalan_sedang), 'z' => 65],
            ['nilai' => min($fuzzy->jumlah_sedang, $fuzzy->jarak_dekat, $fuzzy->cuaca_cerah, $fuzzy->jalan_baikk), 'z' => 78],
        ];

        $numerator = 0;
        $denominator = 0;

        // Logging rule satu per satu
        foreach ($rules as $index => $rule) {
            logger("Rule " . ($index + 1) . ": nilai = " . $rule['nilai'] . ", z = " . $rule['z']);

            if ($rule['nilai'] > 0) {
                $numerator += $rule['nilai'] * $rule['z'];
                $denominator += $rule['nilai'];
            }
        }

        // Jika semua nilai alpha = 0, maka gunakan Zmin = 100
        $z_final = $denominator == 0 ? 100 : $numerator / $denominator;

        // Hitung persentase bonus dari skala maksimal 300
        $presentase = round(($z_final / 300) * 100, 2); // skala z maksimal = 300

        // Simpan hasil fuzzy
        $hasil = new HasilFuzzy();
        $hasil->pemasukan_id = $this->id;
        $hasil->pegawai_id = $this->pegawai_id;
        $hasil->nilai_z = $z_final;
        $hasil->persentase = $presentase;
        $hasil->save();

        // Hitung gaji pokok (misalnya 1 buah = 300)
        $gaji_pokok = $this->jumlah_buah * 300;

        // Hitung bonus berdasarkan persentase dari gaji pokok
        $bonus = round(($presentase / 100) * $gaji_pokok);

        // Total upah
        $total = $gaji_pokok + $bonus;

        // Logging hasil akhir
        logger("JUMLAH BUAH: " . $this->jumlah_buah);
        logger("GAJI POKOK: " . $gaji_pokok);
        logger("PRESENTASE: " . $presentase);
        logger("BONUS: " . $bonus);
        logger("TOTAL: " . $total);

        // Simpan ke riwayat kerja
        \App\Models\RiwayatKerja::create([
            'pegawai_id' => $this->pegawai_id,
            'gaji_pokok' => $gaji_pokok,
            'bonus_nominal' => $bonus,
            'total_upah' => $total,
        ]);

    }







}

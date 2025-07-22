<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzyfikasi extends Model
{
    use HasFactory;

    protected $table = 'tb_fuzzyfikasi';

    protected $fillable = [
        'pegawai_id',
        'pemasukan_id', // ← tambahkan ini
        'jumlah_rendah',
        'jumlah_sedang',
        'jumlah_banyak',
        'jarak_dekat',
        'jarak_sedang',
        'jarak_jauh',
        'cuaca_cerah',
        'cuaca_mendung',
        'cuaca_hujan',
        'jalan_baikk',
        'jalan_sedang',
        'jalan_buruk',
    ];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

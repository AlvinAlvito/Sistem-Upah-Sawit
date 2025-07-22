<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilFuzzy extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'pemasukan_id',  // ✅ tambahkan agar bisa disimpan massal
        'nilai_z',
        'persentase'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function pemasukan()
    {
        return $this->belongsTo(Pemasukan::class, 'pemasukan_id');
    }
}

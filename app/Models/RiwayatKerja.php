<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKerja extends Model
{
    protected $fillable = [
        'pegawai_id', 
        'gaji_pokok',
        'bonus_nominal', 
        'total_upah'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nama', 'umur', 'alamat'];

    public function riwayatKerja()
    {
        return $this->hasMany(RiwayatKerja::class);
    }
}

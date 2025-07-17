<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = ['pegawai_id', 'sektor', 'tanggal', 'jumlah_buah', 'cuaca'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

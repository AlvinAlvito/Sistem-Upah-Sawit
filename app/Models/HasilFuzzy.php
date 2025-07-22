<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilFuzzy extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'nilai_z',
        'persentase'
    ];
}

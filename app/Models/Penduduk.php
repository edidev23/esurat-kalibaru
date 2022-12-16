<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'kk',
        'nama',
        'tmp_lahir',
        'tgl_lahir',
        'jkel',
        'agama',
        'status',
        'pekerjaan',
        'dusun',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
    ];

    public function suratkeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}

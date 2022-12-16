<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function jenissuratkeluar()
    {
        return $this->belongsTo(JenisSuratKeluar::class, 'jns_surat_keluar_id');
    }
}

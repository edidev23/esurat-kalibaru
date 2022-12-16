<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'jns_surat_keluar';
    // public $incrementing = false;
    // public $timestamps = false;

    public function suratkeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }
}

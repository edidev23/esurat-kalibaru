<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Helper
{
    public function PendaftarBaru(){
        $data = DB::table('pendaftaran')->where('status', null)->whereNull('rekening_sekolah_id')->count();
        return $data;
    }

    public function PengajuanBerkas(){
        $data = DB::table('pendaftaran')->where('status', 3)->count();
        return $data;
    }

    public function KonfirmasiPembayaran(){
        $data = DB::table('pembayaran')->where('status', 0)->count();
        return $data;
    }

    public function ProfilSekolah(){
        $data = DB::table('profil_sekolah')->where('id', 1)->first();
        return $data;
    }

    public function TotalUangPendaftaran($rek_id){
        $data = DB::table('pendaftaran')->select(DB::raw('SUM(pembayaran.jumlah) As jumlah'))
        ->join('pembayaran', 'pendaftaran.pembayaran_id', '=', 'pembayaran.id')
        ->where('rekening_sekolah_id', $rek_id)->first();
        return $data;
    }

    public function TotalUangPangkal(){
        $data = DB::table('pembayaran_dpp')->select(DB::raw('SUM(dpp) As jumlah'))->first();
        return $data;
    }
}
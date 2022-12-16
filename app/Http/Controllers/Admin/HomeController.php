<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_keluar = SuratKeluar::take(5)->get()->sortByDesc('created_at');
        $surat_masuk = SuratMasuk::take(5)->get()->sortByDesc('created_at');

        $jml_suratkeluar = SuratKeluar::count();
        $jml_suratmasuk = SuratMasuk::count();

        return view('admin-page/home', compact('surat_keluar', 'surat_masuk', 'jml_suratkeluar', 'jml_suratmasuk'));
    }
}

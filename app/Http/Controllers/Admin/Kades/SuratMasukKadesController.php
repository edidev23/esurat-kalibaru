<?php

namespace App\Http\Controllers\Admin\Kades;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukKadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_masuk = SuratMasuk::all()->sortByDesc('created_at');

        return view('kades-page/surat-masuk/view', compact('surat_masuk'));
    }

    public function show(SuratMasuk $surat_masuk)
    {
        $surat_masuk->status = 1;
        $surat_masuk->save();

        return view('kades-page/surat-masuk/show', compact('surat_masuk'));
    }
}

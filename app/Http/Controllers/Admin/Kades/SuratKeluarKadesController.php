<?php

namespace App\Http\Controllers\Admin\Kades;

use App\Http\Controllers\Controller;
use App\Models\JenisSuratKeluar;
use App\Models\SuratKeluar;
use App\Models\Penduduk;
use App\Models\ProfilDesa;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarKadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_keluar = SuratKeluar::where('ttd_pimpinan', auth()->user()->jabatan)->get()->sortByDesc('created_at');

        return view('kades-page/surat-keluar/view', compact('surat_keluar'));
    }

    public function show(SuratKeluar $surat_keluar)
    {
        $surat_keluar->status = 1;
        $surat_keluar->save();

        return redirect('kades/surat-keluar');
    }
}

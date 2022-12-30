<?php

namespace App\Http\Controllers\Admin\Kades;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluarInternal;

class SuratKeluarInternalKadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_keluar_internal = SuratKeluarInternal::all()->sortByDesc('created_at');

        return view('kades-page/surat-keluar-internal/view', compact('surat_keluar_internal'));
    }

    public function show(SuratKeluarInternal $surat_keluar_internal)
    {
        $surat_keluar_internal->status = 1;
        $surat_keluar_internal->save();

        return view('kades-page/surat-keluar-internal/show', compact('surat_keluar_internal'));
    }
}

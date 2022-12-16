<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSuratKeluar;
use App\Models\SuratKeluar;
use App\Models\Penduduk;
use App\Models\ProfilDesa;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penduduk_array = DB::select('select id, nik, nama from penduduk');

        $data = array();
        $i = 0;
        foreach ($penduduk_array as $p) {
            $data[$i]['id'] = $p->id;
            $data[$i]['name'] = $p->nama . ' / ' . $p->nik;
            $i++;
        }
        $penduduk = json_encode($data);

        $jenis_surat_keluar = JenisSuratKeluar::all()->sortBy('nama');
        $surat_keluar = SuratKeluar::all()->sortByDesc('created_at');

        return view('admin-page/surat-keluar/view', compact('penduduk', 'jenis_surat_keluar', 'surat_keluar'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $d = new SuratKeluar;
        $jenis_surat_keluar = JenisSuratKeluar::findorfail($request->jns_surat_keluar_id);

        // dd($request);

        $this->validate($request, [
            'jns_surat_keluar_id'      => 'required',
            'keterangan'      => 'required',
        ]);

        $d->tgl_surat = Date('Y-m-d');
        $d->tgl_keluar = null;
        $d->no_agenda = $request->no_agenda;
        $d->masa_berlaku = Date('Y-m-d');
        $d->masa_berakhir = Date('Y-m-d');
        $d->jns_surat_keluar_id = $request->jns_surat_keluar_id;
        $d->ttd_pimpinan = $request->ttd_pimpinan;
        $d->keterangan = $request->keterangan;

        if ($jenis_surat_keluar->template == 'surat-kelahiran' || $jenis_surat_keluar->template == 'penghasilan-covid') {
            $d->penduduk_id = $request->ayah_id;
            $d->ibu_id = $request->ibu_id;
        } else {
            $d->penduduk_id = $request->penduduk_id;
        }

        $d->save();

        $jenis_surat_keluar->surat_keluar = $request->no_agenda;
        $jenis_surat_keluar->save();

        toast('Your Post as been submited!', 'success')->autoClose(2000);

        if ($request->btn_save == "save_and_print") {
            return redirect('admin/surat-keluar/cetak/' . $d->id);
        } else {
            return redirect('admin/surat-keluar');
        }
    }

    public function show(SuratKeluar $surat_keluar)
    {
        //
    }

    public function edit(SuratKeluar $surat_keluar)
    {
        $jenis_surat = JenisSuratKeluar::findorfail($surat_keluar->jns_surat_keluar_id);
        $profil_desa = ProfilDesa::findorfail(1);
        $ttd_pimpinan = User::where('jabatan', $surat_keluar->ttd_pimpinan)->first();

        if ($jenis_surat->template == 'surat-kelahiran') {

            $detail_ayah = Penduduk::where('id', $surat_keluar->penduduk_id)->first();
            $detail_ibu = Penduduk::where('id', $surat_keluar->ibu_id)->first();

            return view('admin-page/surat-keluar/edit-surat-kelahiran', compact('surat_keluar', 'detail_ayah', 'detail_ibu', 'jenis_surat', 'profil_desa', 'ttd_pimpinan'));
        } elseif ($jenis_surat->template == 'penghasilan-covid') {

            $detail_ayah = Penduduk::where('id', $surat_keluar->penduduk_id)->first();
            $detail_ibu = Penduduk::where('id', $surat_keluar->ibu_id)->first();

            return view('admin-page/surat-keluar/edit-penghasilan-covid', compact('surat_keluar', 'detail_ayah', 'detail_ibu', 'jenis_surat', 'profil_desa', 'ttd_pimpinan'));
        } elseif ($jenis_surat->template == 'manual') {

            return view('admin-page/surat-keluar/edit-surat-manual', compact('jenis_surat', 'profil_desa', 'ttd_pimpinan', 'surat_keluar'));
        } else {

            $detail_penduduk = Penduduk::where('id', $surat_keluar->penduduk_id)->first();

            return view('admin-page/surat-keluar/edit', compact('surat_keluar', 'detail_penduduk', 'jenis_surat', 'profil_desa', 'ttd_pimpinan'));
        }
    }

    public function update(Request $request, SuratKeluar $surat_keluar)
    {
        $jenis_surat_keluar = JenisSuratKeluar::findorfail($request->jns_surat_keluar_id);

        $this->validate($request, [
            'jns_surat_keluar_id'      => 'required',
            'keterangan'      => 'required',
        ]);

        $surat_keluar->no_agenda = $request->no_agenda;
        $surat_keluar->jns_surat_keluar_id = $request->jns_surat_keluar_id;
        $surat_keluar->keterangan = $request->keterangan;

        if ($jenis_surat_keluar->template == 'surat-kelahiran' || $jenis_surat_keluar->template == 'penghasilan-covid') {
            $surat_keluar->penduduk_id = $request->ayah_id;
            $surat_keluar->ibu_id = $request->ibu_id;
        } else {
            $surat_keluar->penduduk_id = $request->penduduk_id;
        }

        $surat_keluar->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/surat-keluar');
    }

    public function destroy(SuratKeluar $surat_keluar)
    {
        $surat_keluar->delete();
        return redirect('admin/surat-keluar');
    }

    public function pilih_surat(Request $request)
    {

        $jenis_surat = JenisSuratKeluar::findorfail($request->jenis);
        $profil_desa = ProfilDesa::findorfail(1);
        $ttd_pimpinan = User::where('jabatan', $request->ttd)->first();

        if ($jenis_surat->template == 'surat-kelahiran') {

            $detail_ayah = Penduduk::where('id', $request->ayah_id)->first();
            $detail_ibu = Penduduk::where('id', $request->ibu_id)->first();

            return view('admin-page/surat-keluar/surat-kelahiran', compact('jenis_surat', 'detail_ayah', 'detail_ibu', 'profil_desa', 'ttd_pimpinan'));
        } elseif ($jenis_surat->template == 'penghasilan-covid') {

            $detail_ayah = Penduduk::where('id', $request->ayah_id)->first();
            $detail_ibu = Penduduk::where('id', $request->ibu_id)->first();

            return view('admin-page/surat-keluar/surat-penghasilan-covid', compact('jenis_surat', 'detail_ayah', 'detail_ibu', 'profil_desa', 'ttd_pimpinan'));
        } elseif ($jenis_surat->template == 'manual') {

            $detail_penduduk = Penduduk::where('id', $request->penduduk_id)->first();

            return view('admin-page/surat-keluar/surat-manual', compact('jenis_surat', 'detail_penduduk', 'profil_desa', 'ttd_pimpinan'));
        } else {

            $detail_penduduk = Penduduk::where('id', $request->penduduk_id)->first();

            return view('admin-page/surat-keluar/surat-keluar', compact('jenis_surat', 'detail_penduduk', 'profil_desa', 'ttd_pimpinan'));
        }
    }

    public function cetak_surat($id)
    {
        $surat_keluar = SuratKeluar::findorfail($id);
        $surat_keluar->tgl_keluar = Date('Y-m-d');
        $surat_keluar->cetak = $surat_keluar->cetak + 1;
        $surat_keluar->save();

        $profil_desa = ProfilDesa::findorfail(1);
        $ttd_pimpinan = User::where('jabatan', $surat_keluar->ttd_pimpinan)->first();
        $jenis_surat = JenisSuratKeluar::findorfail($surat_keluar->jns_surat_keluar_id);

        // f4
        $customPaper = array(0, 0, 612.00, 1008.0);

        if ($jenis_surat->template == 'surat-kelahiran' || $jenis_surat->template == 'penghasilan-covid') {

            $detail_ayah = Penduduk::where('id', $surat_keluar->penduduk_id)->first();
            $detail_ibu = Penduduk::where('id', $surat_keluar->ibu_id)->first();

            $pdf = PDF::loadView('admin-page/_pdf/' . $jenis_surat->template, compact('surat_keluar', 'detail_ayah', 'detail_ibu', 'jenis_surat', 'profil_desa', 'ttd_pimpinan'))->setPaper('a4');
        } else {

            $detail_penduduk = Penduduk::where('id', $surat_keluar->penduduk_id)->first();
            $pdf = PDF::loadView('admin-page/_pdf/' . $jenis_surat->template, compact('surat_keluar', 'detail_penduduk', 'jenis_surat', 'profil_desa', 'ttd_pimpinan'))->setPaper('a4');
        }

        // $pdf->set_paper($customPaper);
        $pdf->setPaper($customPaper, 'potrait');
        return $pdf->stream();
    }
}

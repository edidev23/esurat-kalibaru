<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_masuk = SuratMasuk::all()->sortByDesc('created_at');

        return view('admin-page/surat-masuk/view', compact('surat_masuk'));
    }

    public function create()
    {
        return view('admin-page/surat-masuk/add');
    }

    public function store(Request $request)
    {
        $d = new SuratMasuk;

        $this->validate($request, [
            'no_agenda'      => 'required',
            'pengirim'      => 'required',
            'tgl_surat'      => 'required',
            'tgl_terima'      => 'required',
            // 'kepada'      => 'required',
            'tujuan'      => 'required',
            'perihal'      => 'required',
            'keterangan'      => 'required',
            'file'    => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048'
        ]);

        $d->no_agenda = $request->no_agenda;
        $d->pengirim = $request->pengirim;
        $d->tgl_surat = tanggal_en($request->tgl_surat);
        $d->tgl_terima = tanggal_en($request->tgl_terima);
        $d->kepada = $request->kepada ? $request->kepada : 'Kepala desa Kalibaru';
        $d->tujuan = $request->tujuan;
        $d->perihal = $request->perihal;
        $d->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            $d->file = $this->UploadFile($request);
        }

        $d->save();

        toast('Your Post as been submited!', 'success')->autoClose(2000);

        if ($request->btn_save == "save_and_print") {
            return redirect('admin/surat-masuk/cetak/' . $d->id);
        } else {
            return redirect('admin/surat-masuk');
        }
    }

    public function show(SuratMasuk $surat_masuk)
    {
        return view('admin-page/surat-masuk/show', compact('surat_masuk'));
    }

    public function edit(SuratMasuk $surat_masuk)
    {
        return view('admin-page/surat-masuk/edit', compact('surat_masuk'));
    }

    public function update(Request $request, SuratMasuk $surat_masuk)
    {
        $this->validate($request, [
            'no_agenda'      => 'required',
            'pengirim'      => 'required',
            'tgl_surat'      => 'required',
            'tgl_terima'      => 'required',
            'kepada'      => 'required',
            'tujuan'      => 'required',
            'perihal'      => 'required',
            'keterangan'      => 'required',
        ]);

        $surat_masuk->no_agenda = $request->no_agenda;
        $surat_masuk->pengirim = $request->pengirim;
        $surat_masuk->tgl_surat = tanggal_en($request->tgl_surat);
        $surat_masuk->tgl_terima = tanggal_en($request->tgl_terima);
        $surat_masuk->kepada = $request->kepada;
        $surat_masuk->tujuan = $request->tujuan;
        $surat_masuk->perihal = $request->perihal;
        $surat_masuk->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            $surat_masuk->file = $this->UploadFile($request, $surat_masuk->file);
        }

        $surat_masuk->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/surat-masuk');
    }

    public function destroy(SuratMasuk $surat_masuk)
    {
        $surat_masuk->delete();
        return redirect('admin/surat-masuk');
    }

    private function UploadFile(Request $request, $old_file = null)
    {
        if ($old_file != '' && file_exists(public_path('upload/arsip-surat-masuk/') . $old_file)) {
            unlink(public_path('upload/arsip-surat-masuk/') . $old_file);
        }

        $gambar = $request->file('file');
        $ext    = $gambar->getClientOriginalExtension();

        if ($request->file('file')->isValid()) {

            $file_name = rand(1000, 99999) . ".$ext";
            $upload_path = "upload/arsip-surat-masuk";
            $request->file('file')->move($upload_path, $file_name);

            return $file_name;
        }
        return false;
    }
}

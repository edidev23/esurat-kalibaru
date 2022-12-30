<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluarInternal;
use Illuminate\Http\Request;

class SuratKeluarInternalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $surat_masuk = SuratKeluarInternal::all()->sortByDesc('created_at');

        return view('admin-page/surat-keluar-internal/view', compact('surat_masuk'));
    }

    public function create()
    {
        return view('admin-page/surat-keluar-internal/add');
    }

    public function store(Request $request)
    {
        $d = new SuratKeluarInternal;

        $this->validate($request, [
            'no_agenda'      => 'required',
            'pengirim'      => 'required',
            'tgl_surat'      => 'required',
            'tgl_keluar'      => 'required',
            // 'kepada'      => 'required',
            'tujuan'      => 'required',
            'perihal'      => 'required',
            'keterangan'      => 'required',
            'file'    => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048'
        ]);

        $d->no_agenda = $request->no_agenda;
        $d->pengirim = $request->pengirim;
        $d->tgl_surat = tanggal_en($request->tgl_surat);
        $d->tgl_keluar = tanggal_en($request->tgl_keluar);
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
            return redirect('admin/surat-keluar-internal/cetak/' . $d->id);
        } else {
            return redirect('admin/surat-keluar-internal');
        }
    }

    public function show(SuratKeluarInternal $surat_keluar_internal)
    {
        return view('admin-page/surat-keluar-internal/show', compact('surat_keluar_internal'));
    }

    public function edit(SuratKeluarInternal $surat_keluar_internal)
    {
        return view('admin-page/surat-keluar-internal/edit', compact('surat_keluar_internal'));
    }

    public function update(Request $request, SuratKeluarInternal $surat_keluar_internal)
    {
        $this->validate($request, [
            'no_agenda'      => 'required',
            'pengirim'      => 'required',
            'tgl_surat'      => 'required',
            'tgl_keluar'      => 'required',
            'kepada'      => 'required',
            'tujuan'      => 'required',
            'perihal'      => 'required',
            'keterangan'      => 'required',
        ]);

        $surat_keluar_internal->no_agenda = $request->no_agenda;
        $surat_keluar_internal->pengirim = $request->pengirim;
        $surat_keluar_internal->tgl_surat = tanggal_en($request->tgl_surat);
        $surat_keluar_internal->tgl_keluar = tanggal_en($request->tgl_keluar);
        $surat_keluar_internal->kepada = $request->kepada;
        $surat_keluar_internal->tujuan = $request->tujuan;
        $surat_keluar_internal->perihal = $request->perihal;
        $surat_keluar_internal->keterangan = $request->keterangan;

        if ($request->hasFile('file')) {
            $surat_keluar_internal->file = $this->UploadFile($request, $surat_keluar_internal->file);
        }

        $surat_keluar_internal->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/surat-keluar-internal');
    }

    public function destroy(SuratKeluarInternal $surat_keluar_internal)
    {
        $surat_keluar_internal->delete();
        return redirect('admin/surat-keluar-internal');
    }

    private function UploadFile(Request $request, $old_file = null)
    {
        if ($old_file != '' && file_exists(public_path('upload/arsip-surat-keluar-internal/') . $old_file)) {
            unlink(public_path('upload/arsip-surat-keluar-internal/') . $old_file);
        }

        $gambar = $request->file('file');
        $ext    = $gambar->getClientOriginalExtension();

        if ($request->file('file')->isValid()) {

            $file_name = rand(1000, 99999) . ".$ext";
            $upload_path = "upload/arsip-surat-keluar-internal";
            $request->file('file')->move($upload_path, $file_name);

            return $file_name;
        }
        return false;
    }
}

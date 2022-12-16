<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\JenisSuratKeluar;
use Illuminate\Http\Request;

class JenisSuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jenissurat = JenisSuratKeluar::all()->sortBy('nama')->sortBy('kode');

        return view('admin-page/jenis-surat-keluar/view', compact('jenissurat'));
    }

    public function create()
    {
        return view('admin-page/jenis-surat-keluar/add');
    }

    public function store(Request $request)
    {
        $d = new JenisSuratKeluar;

        $this->validate($request, [
            'nama'      => 'required',
            'judul'      => 'required',
            'kode'      => 'required',
            'template'      => 'required',
        ]);

        $d->nama = $request->nama;
        $d->judul = $request->judul;
        $d->kode = $request->kode;
        $d->template = $request->template;
        $d->keterangan = $request->keterangan;
        $d->save();

        toast('Your Post as been submited!', 'success')->autoClose(2000);

        if ($request->btn_save == "save_add_another") {
            return redirect('admin/jenis-surat-keluar/create');
        } else {
            return redirect('admin/jenis-surat-keluar');
        }
    }

    public function show(JenisSuratKeluar $jenis_surat_keluar)
    {
        //
    }

    public function edit(JenisSuratKeluar $jenis_surat_keluar)
    {
        return view('admin-page/jenis-surat-keluar/edit', compact('jenis_surat_keluar'));
    }

    public function update(Request $request, JenisSuratKeluar $jenis_surat_keluar)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'judul'      => 'required',
            'kode'      => 'required',
            'template'      => 'required',
        ]);

        $jenis_surat_keluar->nama = $request->nama;
        $jenis_surat_keluar->judul = $request->judul;
        $jenis_surat_keluar->kode = $request->kode;
        $jenis_surat_keluar->template = $request->template;
        $jenis_surat_keluar->keterangan = $request->keterangan;

        $jenis_surat_keluar->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/jenis-surat-keluar');
    }

    public function destroy(JenisSuratKeluar $jenis_surat_keluar)
    {
        // $jenis_surat_keluar->delete();
        return redirect('admin/jenis-surat-keluar');
    }

    public function restore_format($id)
    {
        $jenis_surat_keluar = JenisSuratKeluar::findorfail($id);

        $jenis_surat_keluar->keterangan = $jenis_surat_keluar->master_ket;
        $jenis_surat_keluar->Save();

        toast('Format restore success', 'success')->autoClose(2000);
        return redirect('admin/jenis-surat-keluar');
    }
}

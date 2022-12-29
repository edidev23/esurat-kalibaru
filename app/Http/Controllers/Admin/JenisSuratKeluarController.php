<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\JenisSuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisSuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penduduk_array = DB::select('select id, nik, nama, jkel from penduduk');

        $data = array();
        $i = 0;
        foreach ($penduduk_array as $p) {
            $data[$i]['id'] = $p->id;
            $data[$i]['name'] = $p->nama . ' / ' . $p->nik;
            $data[$i]['jkel'] = $p->jkel;
            $i++;
        }
        $penduduk = json_encode($data);

        $jenissurat = DB::table('surat_keluar')
        ->select(DB::raw('count(*) as total_surat'), 'jns_surat_keluar.*')
        ->join('jns_surat_keluar', 'surat_keluar.jns_surat_keluar_id', '=', 'jns_surat_keluar.id')
        ->groupBy('surat_keluar.jns_surat_keluar_id')
        ->orderByDesc('jns_surat_keluar.nama')
        ->get();

        return view('admin-page/jenis-surat-keluar/view', compact('jenissurat', 'penduduk'));
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

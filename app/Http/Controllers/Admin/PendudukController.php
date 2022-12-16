<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendudukImport;
use App\Models\Penduduk;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $penduduk = penduduk::all()->sortBy('created_at');

        return view('admin-page/penduduk/view', compact('penduduk'));
    }

    public function create()
    {
        $pekerjaan = Pekerjaan::all();
        $desa = 'Kalibaruwetan';
        $kecamatan = 'Kalibaru';
        $kabupaten = 'Banyuwangi';
        return view('admin-page/penduduk/add', compact('pekerjaan', 'desa', 'kecamatan', 'kabupaten'));
    }

    public function store(Request $request)
    {
        $d = new penduduk;

        $this->validate($request, [
            'nama'      => 'required',
            'nik'      => 'required|numeric|digits_between:16,16|unique:penduduk',
            'kk'      => 'required',
            'tmp_lahir'      => 'required',
            'tgl_lahir'      => 'required',
            'jkel'      => 'required',
            'agama'      => 'required',
            'status'      => 'required',
            'pekerjaan'      => 'required',
            'dusun'      => 'required',
            'rt'      => 'required',
            'rw'      => 'required',
            'desa'      => 'required',
            'kecamatan'      => 'required',
            'kabupaten'      => 'required',
        ]);

        $d->nik = $request->nik;
        $d->kk = $request->kk;
        $d->nama = $request->nama;
        $d->tmp_lahir = $request->tmp_lahir;
        $d->tgl_lahir = tanggal_en($request->tgl_lahir);
        $d->jkel = $request->jkel;
        $d->agama = $request->agama;
        $d->status = $request->status;
        $d->pekerjaan = $request->pekerjaan;
        $d->dusun = $request->dusun;
        $d->rt = $request->rt;
        $d->rw = $request->rw;
        $d->desa = $request->desa;
        $d->kecamatan = $request->kecamatan;
        $d->kabupaten = $request->kabupaten;
        $d->save();

        toast('Your Post as been submited!', 'success')->autoClose(2000);

        if ($request->btn_save == "save_add_another") {
            return redirect('admin/penduduk/create');
        } else {
            return redirect('admin/penduduk');
        }
    }

    public function show(penduduk $penduduk)
    {
        return view('admin-page/penduduk/show', compact('penduduk'));
    }

    public function edit(penduduk $penduduk)
    {
        $pekerjaan = Pekerjaan::all();
        return view('admin-page/penduduk/edit', compact('penduduk', 'pekerjaan'));
    }

    public function update(Request $request, penduduk $penduduk)
    {
        $this->validate($request, [
            'nama'      => 'required',
            'nik'      => 'required|numeric|digits_between:16,16|unique:penduduk,nik,' . $penduduk['id'],
            'kk'      => 'required',
            'tmp_lahir'      => 'required',
            'tgl_lahir'      => 'required',
            'jkel'      => 'required',
            'agama'      => 'required',
            'status'      => 'required',
            'pekerjaan'      => 'required',
            'dusun'      => 'required',
            'rt'      => 'required',
            'rw'      => 'required',
            'desa'      => 'required',
            'kecamatan'      => 'required',
            'kabupaten'      => 'required',
        ]);

        $penduduk->nik = $request->nik;
        $penduduk->kk = $request->kk;
        $penduduk->nama = $request->nama;
        $penduduk->tmp_lahir = $request->tmp_lahir;
        $penduduk->tgl_lahir = tanggal_en($request->tgl_lahir);
        $penduduk->jkel = $request->jkel;
        $penduduk->agama = $request->agama;
        $penduduk->status = $request->status;
        $penduduk->pekerjaan = $request->pekerjaan;
        $penduduk->dusun = $request->dusun;
        $penduduk->rt = $request->rt;
        $penduduk->rw = $request->rw;
        $penduduk->desa = $request->desa;
        $penduduk->kecamatan = $request->kecamatan;
        $penduduk->kabupaten = $request->kabupaten;
        $penduduk->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/penduduk');
    }

    public function destroy(penduduk $penduduk)
    {
        try {
            $penduduk->delete();
            return redirect('admin/penduduk');
        } catch (\Illuminate\Database\QueryException $ex) {

            alert()->error('Data penduduk masih digunakan!')->autoClose(3000);
            return redirect('admin/penduduk');
        }
    }

    public function uploadExel(Request $request)
    {
        Excel::import(new PendudukImport, request()->file('file'));

        return redirect('admin/penduduk');
    }
}

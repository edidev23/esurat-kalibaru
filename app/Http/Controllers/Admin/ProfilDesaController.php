<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProfilDesa;

class ProfilDesaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $profil_desa = ProfilDesa::findorfail(1);
        return view('admin-page/profil-desa/view', compact('profil_desa'));
    }

    public function edit(ProfilDesa $profil_desa)
    {
        return view('admin-page/profil-desa/edit', compact('profil_desa'));
    }

    public function update(Request $request, ProfilDesa $profil_desa)
    {
        $profil_desa->kode_desa = $request->kode_desa;
        $profil_desa->desa = $request->desa;
        $profil_desa->kecamatan = $request->kecamatan;
        $profil_desa->kabupaten = $request->kabupaten;
        $profil_desa->kecamatan = $request->kecamatan;
        $profil_desa->kabupaten = $request->kabupaten;
        $profil_desa->alamat = $request->alamat;
        $profil_desa->kode_pos = $request->kode_pos;
        $profil_desa->telepon = $request->telepon;
        $profil_desa->email = $request->email;
        $profil_desa->website = $request->website;
        $profil_desa->save();

        toast('Your Post as been updated!', 'success')->autoClose(2000);
        return redirect('admin/profil-desa');
    }
}

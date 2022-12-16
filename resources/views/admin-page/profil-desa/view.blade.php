@extends('layouts/admin/template_back')

@section('title', "Profil Desa")

@section('bread')
  <h2>Profil Desa</h2>
  <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li class="active"><strong>Profil Desa</strong></li>
  </ol>
@endsection


@section('css')
<style>
  th, td {
      height: 35px;
      font-size: 18px;
      vertical-align: top;
  }
</style>
@endsection

@section('main')

<div class="row">
  <div class="col-lg-12">
    <div class="inqbox">
      <div class="inqbox-title border-top-success">
        <h5>Data Profil Desa</h5>
      </div>
      <div class="inqbox-content">
        <div class="row">
          <div class="col-lg-8">
            <table width="100%">
              <tr>
                <td>Kode Desa</td>
                <td>{{ $profil_desa->kode_desa }}</td>
              </tr>
              <tr>
                <td>Desa</td>
                <td>{{ $profil_desa->desa }}</td>
              </tr>
              <tr>
                <td>Kecamatan</td>
                <td>{{ $profil_desa->kecamatan }}</td>
              </tr>
              <tr>
                <td>Kabupaten</td>
                <td>{{ $profil_desa->kabupaten }}</td>
              </tr>
              <tr>
                <td>Kode Pos</td>
                <td>{{ $profil_desa->kode_pos }}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>{{ $profil_desa->alamat }}</td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>{{ $profil_desa->telepon }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ $profil_desa->email }}</td>
              </tr>
              <tr>
                <td>
                  <a href="{{ url('admin/profil-desa/'. $profil_desa->id .'/edit') }}" class="btn btn-info">Edit Profil Desa</a>
                </td>
              </tr>
            </table>
          </div>
          <div class="col-lg-4">
            <img src="@if($profil_desa->logo != ''){{ asset('upload/'. $profil_desa->logo ) }}@else{{ asset('assets/images/logo_desa.png') }}@endif" class="img-thumbnail" style="height: 250px; width: auto" alt="nama desa">
          </div>
        </div>
        

      </div>
    </div>
  </div>
</div>
@endsection

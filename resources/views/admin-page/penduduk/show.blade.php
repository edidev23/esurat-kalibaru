@extends('layouts/admin/template_back')

@section('title', "Detail Penduduk")

@section('bread')
  <h2>Detail Penduduk</h2>
  <ol class="breadcrumb">
    <li><a href="{{ url('admin') }}">Dashboard</a></li>
    <li><a href="{{ url('admin/penduduk') }}">Penduduk</a></li>
    <li class="active"><strong>Detail</strong></li>
  </ol>
@endsection

@section('main')

<div class="row">
  <div class="col-lg-6">
    <div class="inqbox">
      <div class="inqbox-content">
        <table class="table">
            <tr>
                <td width="20%">Nama</td>
                <td>: {{ $penduduk->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $penduduk->nik }}</td>
            </tr>
            <tr>
                <td>No. KK</td>
                <td>: {{ $penduduk->kk }}</td>
            </tr>
            <tr>
                <td>TTL</td>
                <td>: {{ $penduduk->tmp_lahir }}, {{ tanggal_id($penduduk->tgl_lahir) }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $penduduk->jkel == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td style="text-transform: capitalize">: {{ $penduduk->agama }}</td>
            </tr>
            <tr>
                <td>Status Pernikahan</td>
                <td>: {{ $penduduk->status }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $penduduk->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: Dusun {{ $penduduk->dusun }} RT {{ $penduduk->rt }} RW {{ $penduduk->rw }}<br> &nbsp; Desa {{ $penduduk->desa }} Kecamatan {{ $penduduk->kecamatan }} </td>
            </tr>
        </table>

        <a href="{{ url('admin/penduduk')}}" class="btn btn-danger">Kembali</a>
      </div>
    </div>
  </div>
</div>
@endsection

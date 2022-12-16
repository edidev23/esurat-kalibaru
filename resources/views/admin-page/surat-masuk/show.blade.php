@extends('layouts/admin/template_back')

@section('title', 'Detail Surat Masuk')

@section('bread')
    <h2>Detail Surat Masuk</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}">Dashboard</a></li>
        <li><a href="{{ url('admin/surat-masuk') }}">Surat Masuk</a></li>
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
                            <td>Tanggal Terima <br> Tanggal Surat</td>
                            <td>: {{ tanggal_id($surat_masuk->tgl_terima) }} <br> :
                                {{ tanggal_id($surat_masuk->tgl_surat) }}</td>
                        </tr>
                        <tr>
                            <td width="20%">No Agenda</td>
                            <td>: {{ $surat_masuk->no_agenda }}</td>
                        </tr>
                        <tr>
                            <td>Pengirim</td>
                            <td>: {{ $surat_masuk->pengirim }}</td>
                        </tr>
                        <tr>
                            <td>Kepada</td>
                            <td>: {{ $surat_masuk->kepada }}</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>: {{ $surat_masuk->tujuan }}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>: {{ $surat_masuk->perihal }}</td>
                        </tr>
                        <tr>
                            <td>Isi</td>
                            <td>: {{ $surat_masuk->keterangan }}</td>
                        </tr>

                    </table>

                    <a href="{{ url('admin/surat-masuk') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>

        @if ($surat_masuk->file != '')
            <div class="col-lg-6">
                <div class="inqbox">
                    <div class="inqbox-content">
                        <h3>Berkas</h3>
                        <img src="{{ url('upload/arsip-surat-masuk/' . $surat_masuk->file) }}" alt=""
                            style="width: auto; max-height: 500px; object-fit: contain;">

                        <div style="margin-top: 10px;" >
                            <a href="{{ url('upload/arsip-surat-masuk/' . $surat_masuk->file) }}" target="_blank">Buka File</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@extends('layouts/admin/template_back')

@section('title', 'Detail Surat Keluar')

@section('bread')
    <h2>Detail Surat Keluar</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}">Dashboard</a></li>
        <li><a href="{{ url('admin/surat-keluar-internal') }}">Surat Keluar</a></li>
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
                            <td>Tanggal Keluar <br> Tanggal Surat</td>
                            <td>: {{ tanggal_id($surat_keluar_internal->tgl_keluar) }} <br> :
                                {{ tanggal_id($surat_keluar_internal->tgl_surat) }}</td>
                        </tr>
                        <tr>
                            <td width="20%">No Agenda</td>
                            <td>: {{ $surat_keluar_internal->no_agenda }}</td>
                        </tr>
                        <tr>
                            <td>Pengirim</td>
                            <td>: {{ $surat_keluar_internal->pengirim }}</td>
                        </tr>
                        <tr>
                            <td>Kepada</td>
                            <td>: {{ $surat_keluar_internal->kepada }}</td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>: {{ $surat_keluar_internal->tujuan }}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>: {{ $surat_keluar_internal->perihal }}</td>
                        </tr>
                        <tr>
                            <td>Isi</td>
                            <td>: {{ $surat_keluar_internal->keterangan }}</td>
                        </tr>

                    </table>

                    <a href="{{ url('admin/surat-keluar-internal') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>

        @if ($surat_keluar_internal->file != '')
            <div class="col-lg-6">
                <div class="inqbox">
                    <div class="inqbox-content">
                        <h3>Berkas</h3>
                        <img src="{{ url('upload/arsip-surat-keluar-internal/' . $surat_keluar_internal->file) }}" alt=""
                            style="width: auto; max-height: 500px; object-fit: contain;">

                        <div style="margin-top: 10px;" >
                            <a href="{{ url('upload/arsip-surat-keluar-internal/' . $surat_keluar_internal->file) }}" target="_blank">Buka File</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

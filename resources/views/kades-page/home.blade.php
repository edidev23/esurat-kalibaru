@extends('layouts/admin/template_back')

@section('title', "Dashboard")

@section('bread')
<h2>Dashboard</h2>
@endsection

@section('main')
<div class="row">
  <div class="col-lg-3">
    <div class="widget style1 navy-bg">
      <div class="row">
        <div class="col-xs-4">
          <i class="fa fa-envelope fa-5x"></i>
        </div>
        <div class="col-xs-8 text-right">
          <span>Total Surat Masuk</span>
          <h2 class="font-bold">{{ $jml_suratmasuk }}</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="widget style1 red-bg">
      <div class="row">
        <div class="col-xs-4">
          <i class="fa fa-list-alt fa-5x"></i>
        </div>
        <div class="col-xs-8 text-right">
          <span>Total Surat Keluar</span>
          <h2 class="font-bold">{{ $jml_suratkeluar }}</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="tabs-container">
  <ul class="nav nav-tabs tab-border-top-success">
    <li class="active" style="width:20%"><a data-toggle="tab" href="#tab-suratkeluar">Surat Keluar <br />(5) Terbaru</a>
    </li>
    <li class="" style="width: 20%"><a data-toggle="tab" href="#tab-suratmasuk">Surat Masuk <br />(5) Terbaru</a></li>
  </ul>
  <div class="tab-content">
    <div id="tab-suratkeluar" class="tab-pane active">
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="10%">Tgl. Surat</th>
              <th width="5%">No Agenda</th>
              <th>Untuk <br> Jenis Surat</th>
              <th>TTD</th>
              <th>Status</th>
              <th>Dicetak</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($surat_keluar as $d )
            <tr>
              <td>{{ tanggal_id($d->tgl_surat) }}</td>
              <td>{{ $d->no_agenda }}</td>
              <td>
                {{ $d->penduduk->nama }} <br>
                {{ $d->jenissuratkeluar->nama }}
              </td>
              <td>
                @if($d->ttd_pimpinan == 'kepala_desa')
                Kepala desa
                @else
                Sekretaris Desa
                @endif
              </td>
              <td>
                @if($d->status == 1)
                <span class="badge badge-success">Sudah Dilihat</span>
                @else
                <span class="badge badge-warning">Belum Dilihat</span>
                @endif
              </td>
              <td>@if($d->cetak) {{ $d->cetak }} Kali @else 0 @endif</td>
              <td>{{ tanggal_id($d->created_at) }}</td>
              <td>{{ tanggal_id($d->updated_at) }}</td>
              <td align="center">
                <a href="{{ url('kades/surat-keluar/'. $d->id) }}" class="btn btn-primary">
                  <i class="fa fa-eye"></i>
                </a>
              </td>
            </tr>

            @endforeach
          </tbody>
        </table>

        <a href="{{ url('kades/surat-keluar') }}">Lihat semua <i class="fa fa-arrow-right"
            style="margin-left:5px"></i></a>
      </div>
    </div>
    <div id="tab-suratmasuk" class="tab-pane">
      <div class="panel-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th width="10%">Tgl. Surat <br> Tgl. Masuk</th>
              <th width="5%">No Agenda</th>
              <th>Dari <br> Perihal</th>
              <th>Dokumen</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($surat_masuk as $d )
            <tr>
              <td>{{ tanggal_id($d->tgl_surat) }} <br> {{ tanggal_id($d->tgl_terima) }}</td>
              <td>{{ $d->no_agenda }}</td>
              <td>
                {{ $d->pengirim }} <br>
                {{ $d->perihal }}
              </td>
              <td>
                @if($d->file != '')
                <a href="{{ asset('upload/arsip-surat-masuk/'. $d->file) }}" target="_blank">Lihat Dokumen</a>
                @else
                Tidak ada dokumen
                @endif
              </td>
              <td>
                @if($d->status == 1)
                <span class="badge badge-success">Sudah Dilihat</span>
                @else
                <span class="badge badge-warning">Belum Dilihat</span>
                @endif
              </td>
              <td align="center">
                <a href="{{ url('kades/surat-masuk/'. $d->id) }}" class="btn btn-primary">
                  <i class="fa fa-eye"></i>
                </a>
              </td>
            </tr>

            @endforeach
          </tbody>
        </table>

        <a href="{{ url('kades/surat-masuk') }}">Lihat semua <i class="fa fa-arrow-right"
            style="margin-left:5px"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
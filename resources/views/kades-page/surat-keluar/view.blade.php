@extends('layouts/admin/template_back')

@section('title', "Surat Keluar")

@section('bread')
<h2>Surat Keluar</h2>
<ol class="breadcrumb">
  <li><a href="{{ url('kades') }}">Dashboard</a></li>
  <li class="active"><strong>Surat Keluar</strong></li>
</ol>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('main')

<div class="row">
  <div class="col-lg-12">
    <div class="inqbox">
      <div class="inqbox-title border-top-success">
        <h5>Tabel Surat Keluar</h5>
        <br><br>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Surat
          Keluar</button>
      </div>
      <div class="inqbox-content">
        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th width="10%">Tgl. Surat</th>
                <th width="5%">No Agenda</th>
                <th>Untuk <br> Jenis Surat</th>
                <th>TTD</th>
                <th>Dilihat</th>
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
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#example').DataTable({
        "order": [[ 0, "desc" ]]
    });
  });
</script>

@endsection
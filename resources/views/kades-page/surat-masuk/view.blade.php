@extends('layouts/admin/template_back')

@section('title', "Surat Masuk")

@section('bread')
<h2>Surat Masuk</h2>
<ol class="breadcrumb">
  <li><a href="{{ url('kades') }}">Dashboard</a></li>
  <li class="active"><strong>Surat Masuk</strong></li>
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
        <h5>Tabel Surat Masuk</h5>
      </div>
      <div class="inqbox-content">
        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
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
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable({
        "order": [[ 0, "desc" ]]
      });
  });

</script>

@endsection
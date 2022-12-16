@extends('layouts/admin/template_back')

@section('title', "Data Jenis Surat Keluar")

@section('bread')
<h2>Data Jenis Surat Keluar</h2>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}">Dashboard</a></li>
  <li class="active"><strong>Data Jenis Surat Keluar</strong></li>
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
        <h5>Tabel Data Jenis Surat Keluar</h5>
        <br><br>
        <a href="{{ url('admin/jenis-surat-keluar/create') }}" class="btn btn-success">Tambah Jenis Surat Keluar</a>
      </div>
      <div class="inqbox-content">
        <div class="table-responsive">
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Kode Surat</th>
                <th>Jenis Surat</th>
                <th>Template Surat</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jenissurat as $d )
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $d->kode }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->template }}</td>
                <td>{{ tanggal_id($d->created_at) }}</td>
                <td>{{ tanggal_id($d->updated_at) }}</td>

                <td align="center">
                  <a href="{{ url('admin/jenis-surat-keluar/restore-format/'. $d->id )}}" class="btn btn-warning">
                    <i class="fa fa-recycle"></i>
                  </a>

                  <a href="{{ url('admin/jenis-surat-keluar/'. $d->id .'/edit')}}" class="btn btn-info">
                    <i class="fa fa-pencil"></i>
                  </a>
                  {{-- <a href="#" class="delete btn btn-danger" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>
                  --}}

                  <form id="formDelete-{{ $d->id }}" action="{{url('admin/jenis-surat-keluar', $d->id)}}" method="post"
                    style="display: inline-block;">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                  </form>

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
        "order": [[ 0, "asc" ]]
      });
  });
</script>
<script type="text/javascript">
  $('.delete').click(function(e) {
    e.preventDefault();
    var data_id = $(this).attr('data-id');
    Swal.fire({
      title: 'Confirm Delete',
      text: "Are you sure you want to permanently remove this post ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.value) {
        $('#formDelete-' + data_id).submit();
        Swal.close();
      }
    });
  });
</script>

@endsection
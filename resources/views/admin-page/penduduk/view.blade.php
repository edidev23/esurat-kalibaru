@extends('layouts/admin/template_back')

@section('title', "Data Penduduk")

@section('bread')
<h2>Data Penduduk</h2>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}">Dashboard</a></li>
  <li class="active"><strong>Data Penduduk</strong></li>
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
        <h5>Tabel Data Penduduk</h5>
        <br><br>
        <a href="{{ url('admin/penduduk/create') }}" class="btn btn-success">Tambah Penduduk</a>
        <button class="btn btn-warning" style="margin-left: 10px;" data-toggle="modal" data-target="#modalImport">Import
          Excel</button>
      </div>
      <div class="inqbox-content">
        <div class="table-responsive">
          <table id="example" class="display" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>NAMA</th>
                <th>NIK</th>
                <th>TTL</th>
                <th>JKEL</th>
                <th>STATUS</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penduduk as $d )
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->tmp_lahir }}, {{ tanggal_id($d->tgl_lahir) }}</td>
                <td>{{ $d->jkel == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $d->status }}</td>
                <td align="center">
                  <a href="{{ url('admin/penduduk/'. $d->id) }}" class="btn btn-primary">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a href="{{ url('admin/penduduk/'. $d->id .'/edit')}}" class="btn btn-info">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="delete btn btn-danger" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>

                  <form id="formDelete-{{ $d->id }}" action="{{url('admin/penduduk', $d->id)}}" method="post"
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


<!-- Modal -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{url('admin/upload-excel')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Upload File Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group @if($errors->has('file')) has-error @endif">
            <label class="control-label" for="file">File (.xls .xlsx)</label>
            <input id="file" type="file" name="file" class="form-control" placeholder="File upload" required />

            @if ($errors->has('file'))
            <span for="file" class="help-block">{{ $errors->first('file') }}</span>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
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
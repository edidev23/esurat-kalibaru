@extends('layouts/admin/template_back')

@section('title', "Surat Keluar")

@section('bread')
<h2>Surat Keluar</h2>
<ol class="breadcrumb">
  <li><a href="{{ url('admin') }}">Dashboard</a></li>
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
                  <a href="{{ url('admin/surat-keluar/cetak/'. $d->id)}}" target="_blank" class="btn btn-warning">
                    <i class="fa fa-print"></i>
                  </a>
                  <a href="{{ url('admin/surat-keluar/'. $d->id .'/edit')}}" class="btn btn-info">
                    <i class="fa fa-pencil"></i>
                  </a>
                  <a href="#" class="delete btn btn-danger" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>

                  <form id="formDelete-{{ $d->id }}" action="{{url('admin/surat-keluar', $d->id)}}" method="post"
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="{{ url('admin/surat-keluar/pilih') }}" method="POST">
      {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pilih jenis surat</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group @if($errors->has('jenis')) has-error @endif">
                <label class="control-label" for="jenis">Jenis Surat Keluar</label>
                <select name="jenis" id="jenis" class="form-control" required>
                  <option value="">--- Pilih ---</option>
                  @foreach($jenis_surat_keluar as $jenis)
                  <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                  @endforeach
                </select>

                @if ($errors->has('jenis'))
                <span for="jenis" class="help-block">{{ $errors->first('jenis') }}</span>
                @endif
              </div>

              <div class="form-group @if($errors->has('ttd')) has-error @endif">
                <label class="control-label" for="ttd">TTD</label>
                <select name="ttd" id="ttd" class="form-control" required>
                  <option value="">--- Pilih ---</option>
                  <option value="kepala_desa">Kepala Desa</option>
                  <option value="sekdes">Sekretaris Desa</option>
                </select>

                @if ($errors->has('ttd'))
                <span for="ttd" class="help-block">{{ $errors->first('ttd') }}</span>
                @endif
              </div>

              <div id="nama_penduduk" class="form-group">
                <label class="control-label" for="nik_penduduk">Masukkan Nama/NIK</label>
                <input id="nik_penduduk" class="form-control typeahead twitter-typeahead" data-provide="typeahead"
                  placeholder="Masukkan Nama / NIK Penduduk..." type="text" name="nik">
              </div>
              <input type="hidden" name="penduduk_id" id="penduduk_id">

              <div id="ayah_ibu">
                <div class="form-group">
                  <label class="control-label" for="nik_ayah">Nama Ayah</label>
                  <input id="nik_ayah" class="form-control typeahead twitter-typeahead" data-provide="typeahead"
                    placeholder="Masukkan Nama / NIK Ayah..." type="text" name="nik_ayah">
                </div>
                <input type="hidden" name="ayah_id" id="ayah_id">

                <div class="form-group">
                  <label class="control-label" for="nik_ibu">Nama Ibu</label>
                  <input id="nik_ibu" class="form-control typeahead twitter-typeahead" data-provide="typeahead"
                    placeholder="Masukkan Nama / NIK Ibu..." type="text" name="nik_ibu">
                </div>
                <input type="hidden" name="ibu_id" id="ibu_id">
              </div>


            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Buat Surat</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script type="text/javascript" charset="utf8"
  src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    var $np = $("#nama_penduduk");
    $np.hide();
    var $ayah_ibu = $("#ayah_ibu");
    $ayah_ibu.hide();

    $('#jenis').change(function() {
      var jenis_id = parseInt($(this).val());

      // id jenis_surat_keluar => kelahiran dan penghasilan covid
      if(jenis_id == 1 || jenis_id == 18) {
        $np.hide();
        $ayah_ibu.show();
      } else {
        $np.show();
        $ayah_ibu.hide();
      }

    });

    var data = <?= $penduduk ?>;

    // surat default
    var $input = $("#nik_penduduk");
    $input.typeahead({
      source: data,
      autoSelect: true
    })
    $input.change(function() {
      var current = $input.typeahead("getActive");
      $("#penduduk_id").val(current.id)
    });

    // surat kelahiran
    var $input2 = $("#nik_ayah");
    $input2.typeahead({
      source: data,
      autoSelect: true
    })
    $input2.change(function() {
      var current = $input2.typeahead("getActive");
      $("#ayah_id").val(current.id)
    });

    var $input3 = $("#nik_ibu");
    $input3.typeahead({
      source: data,
      autoSelect: true
    })
    $input3.change(function() {
      var current = $input3.typeahead("getActive");
      $("#ibu_id").val(current.id)
    });

    $('#example').DataTable({
        "order": [[ 0, "desc" ]]
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
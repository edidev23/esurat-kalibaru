@extends('layouts/admin/template_back')

@section('title', 'Data Jenis Surat Keluar')

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
                    <a href="{{ url('admin/jenis-surat-keluar/create') }}" class="btn btn-success">Tambah Jenis Surat
                        Keluar</a>
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
                                    <th>Jmlh Surat Keluar</th>
                                    <th>No Surat Terakhir</th>
                                    {{-- <th>Created At</th>
                <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenissurat as $d)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $d->kode }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->template }}</td>
                                        <td>{{ $d->total_surat }}</td>
                                        <td>{{ $d->surat_keluar }}</td>
                                        {{-- <td>{{ tanggal_id($d->created_at) }}</td>
                <td>{{ tanggal_id($d->updated_at) }}</td> --}}

                                        <td align="center">
                                            <a href="{{ url('admin/jenis-surat-keluar/restore-format/' . $d->id) }}"
                                                class="btn btn-warning">
                                                <i class="fa fa-recycle"></i>
                                            </a>

                                            <a href="{{ url('admin/jenis-surat-keluar/' . $d->id . '/edit') }}"
                                                class="btn btn-info">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            {{-- <a href="{{ url('admin/surat-keluar/pilih/'.  $d->id)}}" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                  </a> --}}

                                            <button onclick="changeJenisSurat({{ $d->id }})" type="button"
                                                class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                            {{-- <a href="#" class="delete btn btn-danger" data-id="{{$d->id}}"><i class="fa fa-trash"></i></a>
                  --}}

                                            <form id="formDelete-{{ $d->id }}"
                                                action="{{ url('admin/jenis-surat-keluar', $d->id) }}" method="post"
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
            <form id="pilih-surat" action="{{ url('admin/surat-keluar/pilih') }}" method="POST">
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
                                <div class="form-group @if ($errors->has('jenis')) has-error @endif">
                                    <label class="control-label" for="jenis">Jenis Surat Keluar</label>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        <option value="">--- Pilih ---</option>
                                        @foreach ($jenissurat as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('jenis'))
                                        <span for="jenis" class="help-block">{{ $errors->first('jenis') }}</span>
                                    @endif
                                </div>

                                <div class="form-group @if ($errors->has('ttd')) has-error @endif">
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
                                    <input id="nik_penduduk" class="form-control typeahead twitter-typeahead"
                                        data-provide="typeahead" placeholder="Masukkan Nama / NIK Penduduk..."
                                        type="text" name="nik">
                                </div>
                                <input type="hidden" name="penduduk_id" id="penduduk_id">

                                <div id="ayah_ibu">
                                    <div class="form-group">
                                        <label class="control-label" for="nik_ayah">Nama Ayah</label>
                                        <input id="nik_ayah" class="form-control typeahead twitter-typeahead"
                                            data-provide="typeahead" placeholder="Masukkan Nama / NIK Ayah..."
                                            type="text" name="nik_ayah">
                                    </div>
                                    <input type="hidden" name="ayah_id" id="ayah_id">

                                    <div class="form-group">
                                        <label class="control-label" for="nik_ibu">Nama Ibu</label>
                                        <input id="nik_ibu" class="form-control typeahead twitter-typeahead"
                                            data-provide="typeahead" placeholder="Masukkan Nama / NIK Ibu..."
                                            type="text" name="nik_ibu">
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
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var data = <?= $penduduk ?>;

            var $np = $("#nama_penduduk");
            $np.hide();
            var $ayah_ibu = $("#ayah_ibu");
            $ayah_ibu.hide();

            $('#jenis').change(function() {
                var jenis_id = parseInt($(this).val());

                // id jenis_surat_keluar => kelahiran dan penghasilan covid
                if (jenis_id == 1 || jenis_id == 18) {
                    $np.hide();
                    $ayah_ibu.show();
                } else {
                    $np.show();
                    $ayah_ibu.hide();
                }

            });

            var pendudukLaki = data.filter(d => d.jkel == "L")
            var pendudukPerempuan = data.filter(d => d.jkel == "P")

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
                source: pendudukLaki,
                autoSelect: true
            })
            $input2.change(function() {
                var current = $input2.typeahead("getActive");
                $("#ayah_id").val(current.id)
            });

            var $input3 = $("#nik_ibu");
            $input3.typeahead({
                source: pendudukPerempuan,
                autoSelect: true
            })
            $input3.change(function() {
                var current = $input3.typeahead("getActive");
                $("#ibu_id").val(current.id)
            });

            $('#pilih-surat').submit(function(e) {
                e.preventDefault();
                var submit = false;
                // evaluate the form using generic validaing
                let elemJenis = document.getElementById("jenis");
                var jenis_id = parseInt(elemJenis.value);

                // id jenis_surat_keluar => kelahiran dan penghasilan covid
                if (jenis_id == 1 || jenis_id == 18) {
                    let nik_ayah = $('#nik_ayah').val()
                    let nik_ibu = $('#nik_ibu').val()

                    if (!nik_ayah) {
                        alert("Data ayah tidak boleh kosong!")
                    } else if (!nik_ibu) {
                        alert("Data ibu tidak boleh kosong!")
                    } else {
                        let checkNik = data.find(d => d.name == nik_ayah)
                        let checkNikIbu = data.find(d => d.name == nik_ibu)
                        if (!checkNik) {
                            alert("Data Ayah tidak ditemukan")
                        } else if (!checkNikIbu) {
                            alert("Data Ibu tidak ditemukan")
                        } else {
                            submit = true
                        }
                    }

                } else {
                    let nik = $('#nik_penduduk').val()
                    if (!nik) {
                        alert("Data Penduduk tidak boleh kosong!")
                    } else {
                        let checkNik = data.find(d => d.name == nik)
                        if (!checkNik) {
                            alert("Data Penduduk tidak ditemukan")
                        } else {
                            submit = true
                        }
                    }
                }

                if (submit)
                    this.submit();
                return false;
            });

            $('#example').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        });

        function changeJenisSurat(jenis_id) {
            let element = document.getElementById("jenis");
            element.value = jenis_id;

            var $np = $("#nama_penduduk");
            $np.hide();
            var $ayah_ibu = $("#ayah_ibu");
            $ayah_ibu.hide();

            // id jenis_surat_keluar => kelahiran dan penghasilan covid
            if (jenis_id == 1 || jenis_id == 18) {
                $np.hide();
                $ayah_ibu.show();
            } else {
                $np.show();
                $ayah_ibu.hide();
            }
        }
    </script>

@endsection
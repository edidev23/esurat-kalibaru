@extends('layouts/admin/template_back')
@section('title', "Tambah Penduduk")
@section('bread')
<h2>Tambah Penduduk</h2>
<ol class="breadcrumb">
    <li><a href="{{ url('admin') }} ">Dashboard</a></li>
    <li><a href="{{ url('admin/penduduk') }} ">Penduduk</a></li>
    <li class="active">
        <strong>Tambah Penduduk</strong>
    </li>
</ol>
@endsection

@section('css')
<link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet">
@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="inqbox float-e-margins">
            <div class="inqbox-content">
                <form action="{{url('admin/penduduk')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('nama')) has-error @endif">
                                <label class="control-label" for="nama">Nama</label>
                                <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama"
                                    value="@if(count($errors) > 0){{old('nama')}}@endif" />

                                @if ($errors->has('nama'))
                                <span for="nama" class="help-block">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('nik')) has-error @endif">
                                <label class="control-label" for="nik">NIK</label>
                                <input id="nik" type="text" name="nik" class="form-control" placeholder="NIK"
                                    value="@if(count($errors) > 0){{old('nik')}}@endif" />

                                @if ($errors->has('nik'))
                                <span for="nik" class="help-block">{{ $errors->first('nik') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('kk')) has-error @endif">
                                <label class="control-label" for="kk">No KK</label>
                                <input id="kk" type="text" name="kk" class="form-control" placeholder="No KK"
                                    value="@if(count($errors) > 0){{old('kk')}}@endif" />

                                @if ($errors->has('kk'))
                                <span for="kk" class="help-block">{{ $errors->first('kk') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('tmp_lahir')) has-error @endif">
                                <label class="control-label" for="tmp_lahir">Tempat Lahir</label>
                                <input id="tmp_lahir" type="text" name="tmp_lahir" class="form-control"
                                    placeholder="Tempat Lahir"
                                    value="@if(count($errors) > 0){{old('tmp_lahir')}}@endif" />

                                @if ($errors->has('tmp_lahir'))
                                <span for="tmp_lahir" class="help-block">{{ $errors->first('tmp_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('tgl_lahir')) has-error @endif">
                                <label class="control-label" for="tgl_lahir">Tgl Lahir</label>
                                <input id="tgl_lahir" type="text" name="tgl_lahir" class="form-control datepicker"
                                    placeholder="Tgl Lahir" value="@if(count($errors) > 0){{old('tgl_lahir')}}@endif" />

                                @if ($errors->has('tgl_lahir'))
                                <span for="tgl_lahir" class="help-block">{{ $errors->first('tgl_lahir') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('jkel')) has-error @endif">
                                <label class="control-label" for="jkel">Jenis Kelamin</label>
                                <br>
                                <label>
                                    <input type="radio" name="jkel" id="laki" value="L" @if(old('jkel')=='L' ) checked
                                        @endif>
                                    Laki-laki
                                </label>

                                <label style="margin-left: 20px">
                                    <input type="radio" name="jkel" id="perempuan" value="P" @if(old('jkel')=='P' )
                                        checked @endif>
                                    Perempuan
                                </label>

                                @if ($errors->has('jkel'))
                                <span for="jkel" class="help-block">{{ $errors->first('jkel') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('agama')) has-error @endif">
                                <label class="control-label" for="agama">Agama</label>
                                <select name="agama" id="agama" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="islam" @if(old('agama')=='islam' ) selected @endif>Islam</option>
                                    <option value="kristen" @if(old('agama')=='kristen' ) selected @endif>Kristen
                                    </option>
                                    <option value="katolik" @if(old('agama')=='katolik' ) selected @endif>Katolik
                                    </option>
                                    <option value="hindu" @if(old('agama')=='hindu' ) selected @endif>Hindu</option>
                                    <option value="budha" @if(old('agama')=='budha' ) selected @endif>Budha</option>
                                </select>

                                @if ($errors->has('agama'))
                                <span for="agama" class="help-block">{{ $errors->first('agama') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('status')) has-error @endif">
                                <label class="control-label" for="status">Status Pernikahan</label>
                                <br>

                                <label>
                                    <input type="radio" name="status" id="belum" value="Belum Kawin"
                                        @if(old('status')=='Belum Kawin' ) checked @endif>
                                    Belum Kawin
                                </label>

                                <label style="margin-left: 20px">
                                    <input type="radio" name="status" id="kawin" value="Kawin"
                                        @if(old('status')=='Kawin' ) checked @endif>
                                    Kawin
                                </label>

                                <br>

                                <label>
                                    <input type="radio" name="status" id="cerai" value="Cerai Mati"
                                        @if(old('status')=='Cerai Mati' ) checked @endif>
                                    Cerai Mati
                                </label>

                                <label style="margin-left: 20px">
                                    <input type="radio" name="status" id="cerai" value="Cerai Hidup"
                                        @if(old('status')=='Cerai Hidup' ) checked @endif>
                                    Cerai Hidup
                                </label>

                                @if ($errors->has('status'))
                                <span for="status" class="help-block">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('pekerjaan')) has-error @endif">
                                <label class="control-label" for="pekerjaan">Pekerjaan</label>
                                <input id="pekerjaan" type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" value="@if(count($errors) > 0){{old('pekerjaan')}}@endif"
                                />
                                {{-- <select name="pekerjaan" id="pekerjaan" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($pekerjaan as $p)
                                    <option value="{{ $p->nama }}" @if(old('pekerjaan')==$p->nama) selected
                                        @endif>{{ $p->nama }}</option>
                                    @endforeach

                                </select> --}}

                                @if ($errors->has('pekerjaan'))
                                <span for="pekerjaan" class="help-block">{{ $errors->first('pekerjaan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <hr>
                            <b>* Alamat Lengkap</b>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('dusun')) has-error @endif">
                                <label class="control-label" for="dusun">Dusun</label>
                                <input id="dusun" type="text" name="dusun" class="form-control" placeholder="Dusun"
                                    value="@if(count($errors) > 0){{old('dusun')}}@endif" />

                                @if ($errors->has('dusun'))
                                <span for="dusun" class="help-block">{{ $errors->first('dusun') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group @if($errors->has('rt')) has-error @endif">
                                <label class="control-label" for="rt">RT</label>
                                <input id="rt" type="text" name="rt" class="form-control" placeholder="RT"
                                    value="@if(count($errors) > 0){{old('rt')}}@endif" />

                                @if ($errors->has('rt'))
                                <span for="rt" class="help-block">{{ $errors->first('rt') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group @if($errors->has('rw')) has-error @endif">
                                <label class="control-label" for="rw">RW</label>
                                <input id="rw" type="text" name="rw" class="form-control" placeholder="RW"
                                    value="@if(count($errors) > 0){{old('rw')}}@endif" />

                                @if ($errors->has('rw'))
                                <span for="rw" class="help-block">{{ $errors->first('rw') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('desa')) has-error @endif">
                                <label class="control-label" for="desa">Desa</label>
                                <input id="desa" type="text" name="desa" class="form-control" placeholder="Desa"
                                    value="@if(count($errors) > 0){{old('desa')}}@else{{ $desa }}@endif" />

                                @if ($errors->has('desa'))
                                <span for="desa" class="help-block">{{ $errors->first('desa') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('kecamatan')) has-error @endif">
                                <label class="control-label" for="kecamatan">Kecamatan</label>
                                <input id="kecamatan" type="text" name="kecamatan" class="form-control"
                                    placeholder="Kecamatan"
                                    value="@if(count($errors) > 0){{old('kecamatan')}}@else{{ $kecamatan }}@endif" />

                                @if ($errors->has('kecamatan'))
                                <span for="kecamatan" class="help-block">{{ $errors->first('kecamatan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group @if($errors->has('kabupaten')) has-error @endif">
                                <label class="control-label" for="kabupaten">Kabupaten</label>
                                <input id="kabupaten" type="text" name="kabupaten" class="form-control"
                                    placeholder="Kabupaten"
                                    value="@if(count($errors) > 0){{old('kabupaten')}}@else{{ $kabupaten }}@endif" />

                                @if ($errors->has('kabupaten'))
                                <span for="kabupaten" class="help-block">{{ $errors->first('kabupaten') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="section">
                        <button type="submit" name="btn_save" value="save_add_another" class="btn btn-success">
                            <i class="fa fa-check"></i> Save & Add Another
                        </button>
                        <button type="submit" name="btn_save" value="save_back" class="btn btn-success">
                            <i class="fa fa-check"></i> Save & Back
                        </button>
                        <a href="{{ url('admin/penduduk') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script>
    // datepicker
        $('.datepicker').datepicker({
           format: "dd-mm-yyyy",
           autoclose: true
        }).data({date: '2012-08-08'}).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
</script>
@endsection
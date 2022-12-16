@extends('layouts/admin/template_back')
@section('title', "Tambah Jenis Surat Keluar")
@section('bread')
<h2>Tambah Jenis Surat Keluar</h2>
<ol class="breadcrumb">
    <li><a href="{{ url('admin') }} ">Dashboard</a></li>
    <li><a href="{{ url('admin/jenis-surat-keluar') }} ">Jenis Surat Keluar</a></li>
    <li class="active">
        <strong>Tambah Jenis Surat Keluar</strong>
    </li>
</ol>
@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="inqbox float-e-margins">
            <div class="inqbox-content">
                <form action="{{url('admin/jenis-surat-keluar')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group @if($errors->has('kode')) has-error @endif">
                        <label class="control-label" for="kode">Kode</label>
                        <input id="kode" type="text" name="kode" class="form-control" placeholder="Kode"
                            value="@if(count($errors) > 0){{old('kode')}}@endif" />

                        @if ($errors->has('kode'))
                        <span for="kode" class="help-block">{{ $errors->first('kode') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('template')) has-error @endif">
                        <label class="control-label" for="template">Template</label>
                        <select name="template" id="template" class="form-control">
                            <option value="surat-keluar" @if(old('template')=='surat-keluar' ) selected @endif>Default
                            </option>
                            <option value="surat-kelahiran" @if(old('template')=='surat-kelahiran' ) selected @endif>
                                Surat Kelahiran</option>
                            <option value="surat-kematian" @if(old('template')=='surat-kematian' ) selected @endif>Surat
                                Kematian</option>
                            <option value="skck" @if(old('template')=='skck' ) selected @endif>SKCK</option>
                            <option value="beda-nama-paspor" @if(old('template')=='beda-nama-paspor' ) selected @endif>
                                Beda Nama Paspor</option>
                            <option value="balik-nama" @if(old('template')=='balik-nama' ) selected @endif>Surat Beda
                                Nama (Balik Nama Sertif.)</option>
                            <option value="penghasilan-covid" @if(old('template')=='penghasilan-covid' ) selected
                                @endif>Penghasilan Covid</option>
                            <option value="manual" @if(old('template')=='manual' ) selected @endif>Manual</option>

                        </select>

                        @if ($errors->has('template'))
                        <span for="template" class="help-block">{{ $errors->first('template') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('nama')) has-error @endif">
                        <label class="control-label" for="nama">Nama</label>
                        <input id="nama" type="text" name="nama" class="form-control" placeholder="Nama"
                            value="@if(count($errors) > 0){{old('nama')}}@endif" />

                        @if ($errors->has('nama'))
                        <span for="nama" class="help-block">{{ $errors->first('nama') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('judul')) has-error @endif">
                        <label class="control-label" for="judul">Judul</label>
                        <input id="judul" type="text" name="judul" class="form-control" placeholder="Judul"
                            value="@if(count($errors) > 0){{old('judul')}}@endif" />

                        @if ($errors->has('judul'))
                        <span for="judul" class="help-block">{{ $errors->first('judul') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('keterangan')) has-error @endif">
                        <label class="control-label" for="keterangan">Keterangan</label>
                        <div class="section mt-5">
                            <textarea name="keterangan" id="keterangan" placeholder="Keterangan"
                                required>@if(count($errors) > 0){{ old('keterangan') }}@endif</textarea>
                        </div>

                        @if ($errors->has('keterangan'))
                        <span for="keterangan" class="help-block">{{ $errors->first('keterangan') }}</span>
                        @endif
                    </div>

                    <hr>
                    <div class="section">
                        <button type="submit" name="btn_save" value="save_add_another" class="btn btn-success">
                            <i class="fa fa-check"></i> Save & Add Another
                        </button>
                        <button type="submit" name="btn_save" value="save_back" class="btn btn-success">
                            <i class="fa fa-check"></i> Save & Back
                        </button>
                        <a href="{{ url('admin/jenis-surat-keluar') }}" class="btn btn-danger">
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
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'keterangan' );
</script>
@endsection
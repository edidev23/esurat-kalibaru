@extends('layouts/admin/template_back') 
@section('title', "Tambah Surat Keluar") 
@section('bread')
    <h2>Tambah Surat Keluar</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }} ">Dashboard</a></li>
        <li><a href="{{ url('admin/surat-keluar-internal') }} ">Surat Keluar</a></li>
        <li class="active">
            <strong>Tambah Surat Keluar</strong>
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
                <form  action="{{url('admin/surat-keluar-internal')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('no_agenda')) has-error @endif">
                                <label class="control-label" for="no_agenda">No Agenda</label>
                                <input id="no_agenda" type="text" name="no_agenda" class="form-control" placeholder="No Agenda" value="@if(count($errors) > 0){{old('no_agenda')}}@endif" />
        
                                @if ($errors->has('no_agenda'))
                                    <span for="no_agenda" class="help-block">{{ $errors->first('no_agenda') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('pengirim')) has-error @endif">
                                <label class="control-label" for="pengirim">Pengirim</label>
                                <input id="pengirim" type="text" name="pengirim" class="form-control" placeholder="Pengirim" value="@if(count($errors) > 0){{old('pengirim')}}@endif" />
        
                                @if ($errors->has('pengirim'))
                                    <span for="pengirim" class="help-block">{{ $errors->first('pengirim') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('tgl_surat')) has-error @endif">
                                <label class="control-label" for="tgl_surat">Tanggal Surat</label>
                                <div class="input-group date">
                                    <input id="tgl_surat" type="text" name="tgl_surat" class="form-control datepicker" placeholder="Tanggal Surat" value="@if(count($errors) > 0){{old('tgl_surat')}}@endif" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
        
                                @if ($errors->has('tgl_surat'))
                                    <span for="tgl_surat" class="help-block">{{ $errors->first('tgl_surat') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('tgl_keluar')) has-error @endif">
                                <label class="control-label" for="tgl_keluar">Tanggal Keluar</label>
                                <div class="input-group date">
                                    <input id="tgl_keluar" type="text" name="tgl_keluar" class="form-control datepicker" placeholder="Tanggal Surat" value="@if(count($errors) > 0){{old('tgl_keluar')}}@endif" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
        
                                @if ($errors->has('tgl_keluar'))
                                    <span for="tgl_keluar" class="help-block">{{ $errors->first('tgl_keluar') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group @if($errors->has('kepada')) has-error @endif">
                                <label class="control-label" for="kepada">Kepada</label>
                                <input id="kepada" type="text" name="kepada" class="form-control" placeholder="Kepada" value="@if(count($errors) > 0){{old('kepada')}}@endif" />
        
                                @if ($errors->has('kepada'))
                                    <span for="kepada" class="help-block">{{ $errors->first('kepada') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('tujuan')) has-error @endif">
                                <label class="control-label" for="tujuan">Tujuan</label>
                                <input id="tujuan" type="text" name="tujuan" class="form-control" placeholder="Tujuan" value="@if(count($errors) > 0){{old('tujuan')}}@endif" />
        
                                @if ($errors->has('tujuan'))
                                    <span for="tujuan" class="help-block">{{ $errors->first('tujuan') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('perihal')) has-error @endif">
                                <label class="control-label" for="perihal">Perihal</label>
                                <input id="perihal" type="text" name="perihal" class="form-control" placeholder="Perihal" value="@if(count($errors) > 0){{old('perihal')}}@endif" />
        
                                @if ($errors->has('perihal'))
                                    <span for="perihal" class="help-block">{{ $errors->first('perihal') }}</span>
                                @endif
                            </div>
                            <div class="form-group @if($errors->has('keterangan')) has-error @endif">
                                <label class="control-label" for="keterangan">Isi Singkat/Ket</label>
                                <textarea name="keterangan" id="keterangan" class="form-control">@if(count($errors) > 0){{old('keterangan')}}@endif</textarea>
        
                                @if ($errors->has('keterangan'))
                                    <span for="keterangan" class="help-block">{{ $errors->first('keterangan') }}</span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('file')) has-error @endif">
                                <label class="control-label" for="file">Hasil Scan</label>
                                <input type="file" name="file" class="form-control" required>

                                @if ($errors->has('file'))
                                    <span for="file" class="help-block">{{ $errors->first('file') }}</span>
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
                        <a href="{{ url('admin/surat-keluar-internal') }}" class="btn btn-danger">
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
           autoclose: true,
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    </script>
@endsection
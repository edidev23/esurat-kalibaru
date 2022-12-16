@extends('layouts/admin/template_back') 
@section('title', "Edit Profil Desa") 
@section('bread')
    <h2>Edit Profil Desa</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }} ">Dashboard</a></li>
        <li><a href="{{ url('admin/profil-desa') }} ">Profil Desa</a></li>
        <li class="active">
            <strong>Edit Profil Desa</strong>
        </li>
    </ol>
@endsection

@section('main')

<div class="row">
    <div class="col-lg-12">
        <div class="inqbox float-e-margins">
            <div class="inqbox-content">
                <form  action="{{ url('admin/profil-desa', $profil_desa->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    {{ csrf_field() }}

                    <div class="form-group @if($errors->has('kode_desa')) has-error @endif">
                        <label class="control-label" for="kode_desa">Kode Desa</label>
                        <input id="kode_desa" type="text" name="kode_desa" class="form-control" placeholder="Kode Desa" value="@if(count($errors) > 0){{old('kode_desa')}}@else{{ $profil_desa->kode_desa }}@endif" />

                        @if ($errors->has('kode_desa'))
                            <span for="kode_desa" class="help-block">{{ $errors->first('kode_desa') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('desa')) has-error @endif">
                        <label class="control-label" for="desa">Desa</label>
                        <input id="desa" type="text" name="desa" class="form-control" placeholder="Desa" value="@if(count($errors) > 0){{old('desa')}}@else{{ $profil_desa->desa }}@endif" />

                        @if ($errors->has('desa'))
                            <span for="desa" class="help-block">{{ $errors->first('desa') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('kecamatan')) has-error @endif">
                        <label class="control-label" for="kecamatan">Kecamatan</label>
                        <input id="kecamatan" type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" value="@if(count($errors) > 0){{old('kecamatan')}}@else{{ $profil_desa->kecamatan }}@endif" />

                        @if ($errors->has('kecamatan'))
                            <span for="kecamatan" class="help-block">{{ $errors->first('kecamatan') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('kabupaten')) has-error @endif">
                        <label class="control-label" for="kabupaten">Kabupaten</label>
                        <input id="kabupaten" type="text" name="kabupaten" class="form-control" placeholder="Kabupaten" value="@if(count($errors) > 0){{old('kabupaten')}}@else{{ $profil_desa->kabupaten }}@endif" />

                        @if ($errors->has('kabupaten'))
                            <span for="kabupaten" class="help-block">{{ $errors->first('kabupaten') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('alamat')) has-error @endif">
                        <label class="control-label" for="alamat">Alamat</label>
                        <input id="alamat" type="text" name="alamat" class="form-control" placeholder="Alamat" value="@if(count($errors) > 0){{old('alamat')}}@else{{ $profil_desa->alamat }}@endif" />

                        @if ($errors->has('alamat'))
                            <span for="alamat" class="help-block">{{ $errors->first('alamat') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('kode_pos')) has-error @endif">
                        <label class="control-label" for="kode_pos">Kode Pos</label>
                        <input id="kode_pos" type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" value="@if(count($errors) > 0){{old('kode_pos')}}@else{{ $profil_desa->kode_pos }}@endif" />

                        @if ($errors->has('kode_pos'))
                            <span for="kode_pos" class="help-block">{{ $errors->first('kode_pos') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('telepon')) has-error @endif">
                        <label class="control-label" for="telepon">Telepon</label>
                        <input id="telepon" type="text" name="telepon" class="form-control" placeholder="Telepon" value="@if(count($errors) > 0){{old('telepon')}}@else{{ $profil_desa->telepon }}@endif" />

                        @if ($errors->has('telepon'))
                            <span for="telepon" class="help-block">{{ $errors->first('telepon') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label class="control-label" for="email">Email</label>
                        <input id="email" type="text" name="email" class="form-control" placeholder="Email" value="@if(count($errors) > 0){{old('email')}}@else{{ $profil_desa->email }}@endif" />

                        @if ($errors->has('email'))
                            <span for="email" class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if($errors->has('website')) has-error @endif">
                        <label class="control-label" for="website">Website</label>
                        <input id="website" type="text" name="website" class="form-control" placeholder="Website" value="@if(count($errors) > 0){{old('website')}}@else{{ $profil_desa->website }}@endif" />

                        @if ($errors->has('website'))
                            <span for="website" class="help-block">{{ $errors->first('website') }}</span>
                        @endif
                    </div>

                    <hr>
                    <div class="section">
                        <button type="submit" name="btn_save" value="save_back" class="btn btn-success">
                            <i class="fa fa-check"></i> Save & Back
                        </button>
                        <a href="{{ url('admin/profil-desa') }}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

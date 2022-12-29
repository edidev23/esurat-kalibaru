@extends('layouts/admin/template_back') 
@section('title', "Tambah Surat Keluar") 
@section('bread')
    <h2>Tambah Surat Keluar</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }} ">Dashboard</a></li>
        <li><a href="{{ url('admin/surat-keluar') }} ">Surat Keluar</a></li>
        <li class="active">
            <strong>Tambah Surat Keluar</strong>
        </li>
    </ol>
@endsection

@section('css')

<style>
    th, td {
        height: 35px;
        font-size: 18px;
        vertical-align: top;
    }
    .height-70 {
        height: 50px;
    }
    .text-judul {
        font-size: 22px
    }
    .text-heading {
        font-size: 18px;
        margin-bottom: 30px
    }
    .mt-5 {
        margin-top: 30px
    }
    p {
        font-size: 18px;
    }
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="inqbox float-e-margins">
            <div class="inqbox-content">
                <form  action="{{url('admin/surat-keluar')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="col-lg-12">
                            <h3 class="text-center text-judul">{{ $jenis_surat->nama }}</h3>
                            <p class="text-center text-heading">Nomor: {{ $jenis_surat->kode }}/
                                <input type="text" name="no_agenda" value="{{ $jenis_surat->surat_keluar + 1 }}" style="width: 50px">
                                /{{ $profil_desa->kode_desa }}/{{ Date('Y') }}</p>
                        </div>

                        <div class="col-lg-12">
                            <table>
                                <tr>
                                    <td>Yang bertanda tangan dibawah:</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $ttd_pimpinan->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td class="height-70">: @if($ttd_pimpinan->jabatan == 'kepala_desa') Kepala Desa {{ $profil_desa->desa }} @elseif($ttd_pimpinan->jabatan == 'sekdes') Sekretaris Desa {{ $profil_desa->desa }} @endif</td>
                                </tr>
                            </table>

                            <p>Adalah anak kandung dari suami istri tersebut dibawah ini :</p>
                            <table>
                                <tr>
                                    <td width="250px">AYAH</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $detail_ayah->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $detail_ayah->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat/Tgl Lahir</td>
                                    <td>: {{ $detail_ayah->tmp_lahir }}, {{ tanggal_id($detail_ayah->tgl_lahir) }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $detail_ayah->dusun }} RT. {{ $detail_ayah->rt }} RW. {{ $detail_ayah->rw }} Desa {{ $detail_ayah->desa }}</td>
                                </tr>
                            </table>
                            <br>
                            <table>
                                <tr>
                                    <td width="250px">IBU</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $detail_ibu->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $detail_ibu->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat/Tgl Lahir</td>
                                    <td>: {{ $detail_ibu->tmp_lahir }}, {{ tanggal_id($detail_ibu->tgl_lahir) }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $detail_ibu->dusun }} RT. {{ $detail_ibu->rt }} RW. {{ $detail_ibu->rw }} Desa {{ $detail_ibu->desa }}</td>
                                </tr>
                            </table>
                            
                        </div>

                        <div class="col-lg-12">
                            <div class="section mt-5">
                                <input type="hidden" name="ayah_id" value="{{ $detail_ayah->id }}">
                                <input type="hidden" name="ibu_id" value="{{ $detail_ibu->id }}">
                                <input type="hidden" name="ttd_pimpinan" value="{{ $ttd_pimpinan->jabatan }}">
                                <input type="hidden" name="jns_surat_keluar_id" value="{{ $jenis_surat->id }}">
                                <textarea name="keterangan" id="keterangan" placeholder="keterangan" required>{{ $jenis_surat->keterangan }}</textarea>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="section">
                        <button type="submit" name="btn_save" value="save_and_print" class="btn btn-success">
                            <i class="fa fa-check"></i> Saves & Cetak
                        </button>
                        <button type="submit" name="btn_save" value="save_back" class="btn btn-success">
                            <i class="fa fa-check"></i> Save Sementara
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
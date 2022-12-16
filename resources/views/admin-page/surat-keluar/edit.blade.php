@extends('layouts/admin/template_back') 
@section('title', "Edit Surat Keluar") 
@section('bread')
    <h2>Edit Surat Keluar</h2>
    <ol class="breadcrumb">
        <li><a href="{{ url('admin') }} ">Dashboard</a></li>
        <li><a href="{{ url('admin/surat-keluar') }} ">Surat Keluar</a></li>
        <li class="active">
            <strong>Edit Surat Keluar</strong>
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
</style>
@endsection

@section('main')
<div class="row">
    <div class="col-lg-12">
        <div class="inqbox float-e-margins">
            <div class="inqbox-content">
                <form  action="{{url('admin/surat-keluar', $surat_keluar->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="col-lg-12">
                            <h3 class="text-center text-judul">{{ $jenis_surat->nama }}</h3>
                            <p class="text-center text-heading">Nomor: {{ $jenis_surat->kode }}/
                                <input type="text" name="no_agenda" value="{{ $surat_keluar->no_agenda }}" style="width: 50px">
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
                                <tr>
                                    <td>Dengan ini menerangkan bahwa:</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $detail_penduduk->nama }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: {{ $detail_penduduk->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Tempat/TGL. Lahir</td>
                                    <td>: {{ $detail_penduduk->tmp_lahir }}, {{ $detail_penduduk->tgl_lahir }}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>: @if($detail_penduduk->jkel == 'L') Laki-laki @else Perempuan @endif</td>
                                </tr>
                                <tr>
                                    <td>Status Perkawinan</td>
                                    <td>: {{ $detail_penduduk->status }}</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>: {{ $detail_penduduk->agama }}</td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: {{ $detail_penduduk->pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: Dusun {{ $detail_penduduk->dusun }} RT. {{ $detail_penduduk->rt }} RW. {{ $detail_penduduk->rw }} <br>
                                        &nbsp;&nbsp;Desa {{ $detail_penduduk->desa }} <br>
                                        &nbsp;&nbsp;Kecamatan {{ $detail_penduduk->kecamatan }} Kab. {{ $detail_penduduk->kabupaten }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-12">
                            <div class="section mt-5">
                                <input type="hidden" name="penduduk_id" value="{{ $detail_penduduk->id }}">
                                <input type="hidden" name="jns_surat_keluar_id" value="{{ $jenis_surat->id }}">
                                <textarea name="keterangan" id="keterangan" placeholder="keterangan" required>{{ $surat_keluar->keterangan }}</textarea>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="section">
                        <button type="submit" name="btn_save" value="save_back" class="btn btn-success">
                            <i class="fa fa-check"></i> Save
                        </button>
                        <a href="{{ url('admin/surat-keluar') }}" class="btn btn-danger">
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
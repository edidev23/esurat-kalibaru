<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $jenis_surat->nama }} - {{ $detail_penduduk->nama }}</title>

    <style>
        body {
            margin: 0;
            padding: 0 40px;
        }

        p {
            line-height: 1.8em;
            text-align: justify;
            text-indent: 40px;
            margin-top: 0;
            margin-bottom: 0;
            margin-right: 40px;

            font-size: <?php echo $jenis_surat->size_font ?>px;
        }

        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .mb-1 {
            margin-bottom: 1rem
        }

        .mt-1 {
            margin-top: 1rem
        }

        .mb-2 {
            margin-bottom: 2rem
        }

        .mt-2 {
            margin-top: 2rem
        }

        table {
            margin-top: 10px;
        }

        table,
        th,
        td {
            vertical-align: top;
            height: 28px;

            font-size: <?php echo $jenis_surat->size_font ?>px;
        }

        .font-18 {
            font-size: 18px;
        }

        .cover-logo {
            height: 120px;
            width: 70px;
            position: absolute;
            top: 0px;
            left: 60px;
            /* border: 2px solid black;  */
        }

        .cover-logo img {
            height: auto;
            width: 100%;
            margin-top: 10px
        }

        .kop-surat {
            text-align: center;
            font-size: 18px;
            text-transform: uppercase;
            position: relative;
        }

        .font-capitalize {
            text-transform: capitalize;
        }

        .font-uppercase {
            text-transform: lowercase;
        }

        .garis {
            border: 3px solid black;
            margin: 10px 5px 10px 5px;
        }
    </style>
</head>

<body>

    <div class="cover-logo">
        <img src="{{ public_path('assets/images/logo_desa.png')}}">
    </div>

    <div class="kop-surat">
        PEMERINTAH KABUPATEN {{ $profil_desa->kabupaten }} <br>
        KECAMATAN {{ $profil_desa->kecamatan }} <br>
        DESA {{ $profil_desa->desa }} <br>

        <span class="font-capitalize">{{ $profil_desa->alamat }} Tel. {{ $profil_desa->telepon }}</span> <br>
        <span class="font-capitalize">Kode Pos {{ $profil_desa->kode_pos }}</span> <br>
        <span class="font-uppercase"><i>e-mail {{ $profil_desa->email }}</i></span>
    </div>

    <hr class="garis">

    <div class="text-center mt-2">
        <div class="text-bold font-18" style="text-decoration: underline">{{ $jenis_surat->judul }}</div>
        <span class="font-18">Nomor :
            {{ $jenis_surat->kode }}/{{ $surat_keluar->no_agenda }}/{{ $profil_desa->kode_desa}}/{{ Date('Y')}}</span>
    </div>

    <div class="mt-2">
        <table width="100%">
            <tr>
                <td colspan="3">Yang bertanda tangan dibawah:</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="30%">Nama</td>
                <td>: {{ $ttd_pimpinan->name }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td>Jabatan</td>
                <td class="height-70">: @if($ttd_pimpinan->jabatan == 'kepala_desa') Kepala Desa
                    {{ $profil_desa->desa }} @elseif($ttd_pimpinan->jabatan == 'sekdes') Sekretaris Desa
                    {{ $profil_desa->desa }} @endif</td>
            </tr>
            <tr>
                <td colspan="3">Dengan ini menerangkan bahwa:</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2">Berdasarkan Dokumen KK No. {{ $detail_penduduk->kk }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td>Nama</td>
                <td>: {{ $detail_penduduk->nama }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td>NIK</td>
                <td>: {{ $detail_penduduk->nik }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td>Tempat/Tgl. Lahir</td>
                <td>: {{ $detail_penduduk->tmp_lahir }}, {{ tanggal_id($detail_penduduk->tgl_lahir) }}</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td>Alamat</td>
                <td>
                    <span style="line-height: 1.5em">
                        : Dusun {{ $detail_penduduk->dusun }} RT. {{ $detail_penduduk->rt }} RW.
                        {{ $detail_penduduk->rw }} <br>
                        &nbsp;&nbsp;Desa {{ $detail_penduduk->desa }} <br>
                        &nbsp;&nbsp;Kecamatan {{ $detail_penduduk->kecamatan }} Kab. {{ $detail_penduduk->kabupaten }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="">
        <?= $surat_keluar->keterangan ?>
    </div>

    <div class="mt-1">
        <table width="100%">
            <tr>
                <td></td>
                <td width="50%" align="center">
                    <div class="font-18">{{ $profil_desa->desa }}, {{ tanggal_indo($surat_keluar->tgl_keluar) }}</div>

                    @if($ttd_pimpinan->jabatan == 'sekdes')
                    <div class="font-18">
                        A.N. Kepala Desa {{ $profil_desa->desa }} <br>
                        Sekdes
                    </div>

                    <div class="text-bold" style="margin-top: 120px; text-decoration: underline">
                        {{ $ttd_pimpinan->name }}</div>
                    @else
                    <div class="font-18">Kepala Desa {{ $profil_desa->desa }}</div>

                    <div class="text-bold" style="margin-top: 100px; text-decoration: underline">
                        {{ $ttd_pimpinan->name }}</div>
                    @endif
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
<?php

use App\Helpers\Helper;


function getCurrentUrl()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";
    // Append the host(domain name, ip) to the URL.   
    $url .= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL   
    $url .= $_SERVER['REQUEST_URI'];

    return $url;
}

function formatHari($tanggal)
{
    $hari = date("D", strtotime($tanggal));

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");

    $terbilang = "";
    if ($angka < 12) {
        $terbilang = " " . $baca[$angka];
    } else if ($angka < 20) {
        $terbilang = terbilang($angka - 10) . " Belas";
    } else if ($angka < 100) {
        $terbilang = terbilang($angka / 10) . " Puluh" . terbilang($angka % 10);
    } else if ($angka < 200) {
        $terbilang = " Seratus" . terbilang($angka - 100);
    } else if ($angka < 1000) {
        $terbilang = terbilang($angka / 100) . " Ratus" . terbilang($angka % 100);
    } else if ($angka < 2000) {
        $terbilang = " Seribu" . terbilang($angka - 1000);
    } else if ($angka < 1000000) {
        $terbilang = terbilang($angka / 1000) . " Ribu" . terbilang($angka % 1000);
    } else if ($angka < 1000000000) {
        $terbilang = terbilang($angka / 1000000) . " Juta" . terbilang($angka % 1000000);
    }

    return $terbilang;
}

function input_angka($angka)
{
    return preg_replace("/[^0-9]/", "", $angka);
}

function rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ",", ".");
}

function telepon_id($number)
{
    $kode_telp = substr($number, 0, 2);
    if ($kode_telp == '08') {
        $telepon = '628' . substr($number, 2, 12);

        return $telepon;
    } else {
        return $number;
    }
}

function telepon_back($number)
{
    $kode_telp = substr($number, 0, 3);
    if ($kode_telp == '628') {
        $telepon = '08' . substr($number, 3, 12);

        return $telepon;
    } else {
        return $number;
    }
}

function tanggal_id($tanggal)
{
    //potong 
    $tanggal2 = substr($tanggal, 8, 2);
    $bulan = substr($tanggal, 5, 2);
    $tahun = substr($tanggal, 0, 4);

    if ($tahun == null) {
        $result = null;
    } else {
        $result = $tanggal2 . '-' . $bulan . '-' . $tahun;
    }
    return $result;
}

function tanggal_en($tanggal)
{
    $tanggal2 = substr($tanggal, 0, 2);
    $bulan = substr($tanggal, 3, 2);
    $tahun = substr($tanggal, 6, 4);
    return $tahun . '-' . $bulan . '-' . $tanggal2;
}

function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

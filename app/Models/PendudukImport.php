<?php

namespace App\Models;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PendudukImport implements ToModel, WithUpserts
{
    /**
     * @param array $row
     *
     * @return Penduduk|null
     */
    public function uniqueBy()
    {
        return 'nik';
    }

    public function model(array $row)
    {
        if (!isset($row[2])) {
            return null;
        }

        return new Penduduk([
            'nama'     => $row[1],
            'nik'    => $row[2],
            'kk'    => $row[3],
            'tmp_lahir'    => $row[4],
            'tgl_lahir'    => $this->transformDate($row[5]),
            'jkel'    => $this->checkJkel($row[6]),
            'agama'    => strtolower($row[7]),
            'status'    => $row[8],
            'pekerjaan'    => $row[9],
            'dusun'    => $row[10],
            'rt'    => $row[11],
            'rw'    => $row[12],
            'desa'    => $row[13],
            'kecamatan'    => $row[14],
            'kabupaten'    => $row[15],
        ]);
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function checkJkel($jkel)
    {
        if (strtolower($jkel) == 'perempuan') {
            return 'P';
        } else {
            return 'L';
        }
    }
}

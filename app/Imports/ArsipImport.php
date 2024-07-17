<?php

namespace App\Imports;

use App\Models\Dataarsip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArsipImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dataarsip([
            "noarsip" => $row["noarsip"],
            "nama_arsip" => $row["nama_arsip"],
            "pencipta_id" => $row["pencipta_id"],
            "pengolah_id" => $row["pengolah_id"],
            "kode_id" => $row["kode_id"],
            "lokasi_id" => $row["lokasi_id"],
            "media_id" => $row["media_id"],
            "user_id" => auth()->id(),
            "tanggal_arsip" => $row["tanggal_arsip"],
            "ket" => $row["ket"],
            "uraian" => $row["uraian"],
            "jumlah_arsip" => $row["jumlah_arsip"],
            "no_box" => $row["no_box"],
            "file_arsip" => "default/arsip_contoh.pdf",
        ]);
    }
}

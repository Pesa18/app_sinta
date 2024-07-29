<?php

namespace App\Imports;

use App\Models\Dataarsip;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ArsipImport implements ToModel, WithHeadingRow, WithValidation
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
            "tanggal_arsip" => Carbon::createFromFormat('d/m/Y', $row["tanggal_arsip"])->format("Y-m-d"),
            "ket" => $row["ket"],
            "uraian" => $row["uraian"],
            "jumlah_arsip" => $row["jumlah_arsip"],
            "no_box" => $row["no_box"],
            "file_arsip" => "default/arsip_contoh.pdf",
        ]);
    }

    public function rules(): array
    {
        return [

            "noarsip" => "required",
            "nama_arsip" => "required",
            "pencipta_id" => "required",
            "pengolah_id" => "required",
            "kode_id" => "required",
            "lokasi_id" => "required",
            "media_id" => "required",
            "tanggal_arsip" => "required",
            "ket" => "required",
            "uraian" => "required",
            "jumlah_arsip" => "required",
            "no_box" => "required",
        ];
    }
}

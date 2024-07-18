<?php

namespace App\Imports;

use App\Models\ArsipPegawai;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ArsipPegawaiImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ArsipPegawai([
            "nama_lengkap" => $row["nama_lengkap"],
            "tempat_lahir" => $row["tempat_lahir"],
            "tgl_lahir" => $row["tgl_lahir"],
            "jenis_kelamin" => $row["jenis_kelamin"],
            "agama" => $row["agama"],
            "alamat" => $row["alamat"],
            "no_hp" => $row["no_hp"],
            "email" => $row["email"],
            "nip" => $row["nip"],
            "nik" => $row["nik"],
            "status_pegawai" => $row["status_pegawai"],
            "satker" => $row["satker"],
            "pangkat_gol" => $row["pangkat_gol"],
            "jabatan" => $row["jabatan"],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'nip' => 'required',
            'status_pegawai' => 'required',
            'satker' => 'required',
        ];
    }
}

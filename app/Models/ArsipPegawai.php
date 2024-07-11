<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipPegawai extends Model
{
    use HasFactory;
    protected $table = 'arsip_pegawai';
    protected $guarded = ['id'];


    public function pegawai()
    {
        return $this->hasMany(Dataarsip::class, "arsip_pegawai_id", "id");
    }
}

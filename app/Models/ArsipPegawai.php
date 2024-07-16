<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArsipPegawai extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'arsip_pegawai';
    protected $guarded = [];
    protected $primaryKey = 'uuid';


    public function pegawai()
    {
        return $this->hasMany(Dataarsip::class, "arsip_pegawai_id", "uuid");
    }
}

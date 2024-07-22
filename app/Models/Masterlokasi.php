<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Masterlokasi extends Model
{
    use HasFactory;

    protected $table = 'master_lokasi';

    public function arsip(): HasMany
    {
        return $this->hasMany(Dataarsip::class, "lokasi_id", "id");
    }
}

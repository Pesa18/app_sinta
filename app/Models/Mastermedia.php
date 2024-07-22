<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mastermedia extends Model
{
    use HasFactory;

    protected $table = 'master_media';

    public function arsip(): HasMany
    {
        return $this->hasMany(Dataarsip::class, "media_id", "id");
    }
}

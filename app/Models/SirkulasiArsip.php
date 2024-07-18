<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SirkulasiArsip extends Model
{
    use HasFactory;

    protected $table = "sirkulasi_arsip";
    protected $guarded = ['id'];



    public function arsipId(): BelongsTo
    {
        return $this->belongsTo(Dataarsip::class, 'arsip_id', 'uuid');
    }
    public function userId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

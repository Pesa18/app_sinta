<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dataarsip extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'data-arsip';
    protected $guarded = ['id'];
    protected $primaryKey = 'uuid';

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->user_id = auth()->user()->id;
    //     });
    // }



    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Pencipta(): BelongsTo
    {
        return $this->belongsTo(Masterpencipta::class, 'pencipta_id', 'id');
    }
    public function Pengolah(): BelongsTo
    {
        return $this->belongsTo(Masterpengolah::class, 'pengolah_id', 'id');
    }
    public function Kode(): BelongsTo
    {
        return $this->belongsTo(Masterkode::class, 'kode_id', 'id');
    }
    public function Lokasi(): BelongsTo
    {
        return $this->belongsTo(Masterlokasi::class, 'lokasi_id', 'id');
    }
    public function Media(): BelongsTo
    {
        return $this->belongsTo(Mastermedia::class, 'media_id', 'id');
    }
}

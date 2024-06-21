<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Dataarsip extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'data-arsip';
    protected $guarded = ['id'];
    protected $primaryKey = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            $model->user_id = Auth::user()->id;
        });
    }


    public function Pencipta(): BelongsTo
    {
        return $this->belongsTo(Masterpencipta::class, 'pencipta_id', 'id');
    }
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

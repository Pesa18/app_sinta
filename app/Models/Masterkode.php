<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterkode extends Model
{
    use HasFactory;
    protected $table = "master-kode";
    protected $primaryKey = 'kode';
    protected $guarded = [];
}

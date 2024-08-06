<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\ArsippegawaiResource;

class CreateArsippegawai extends CreateRecord
{
    protected static string $resource = ArsippegawaiResource::class;

    public function getTitle(): string | Htmlable
    {
        return "Buat Pegawai";
    }
}

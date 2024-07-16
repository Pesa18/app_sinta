<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\ArsippegawaiResource;

class EditArsippegawai extends EditRecord
{
    protected static string $resource = ArsippegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected static ?string $navigationLabel = 'Edit Pegawai';
}

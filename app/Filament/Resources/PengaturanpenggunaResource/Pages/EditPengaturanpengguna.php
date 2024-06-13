<?php

namespace App\Filament\Resources\PengaturanpenggunaResource\Pages;

use App\Filament\Resources\PengaturanpenggunaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanpengguna extends EditRecord
{
    protected static string $resource = PengaturanpenggunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

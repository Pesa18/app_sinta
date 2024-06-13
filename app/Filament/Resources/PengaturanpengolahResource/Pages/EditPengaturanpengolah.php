<?php

namespace App\Filament\Resources\PengaturanpengolahResource\Pages;

use App\Filament\Resources\PengaturanpengolahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanpengolah extends EditRecord
{
    protected static string $resource = PengaturanpengolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

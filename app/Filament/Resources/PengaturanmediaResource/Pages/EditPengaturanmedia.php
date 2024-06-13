<?php

namespace App\Filament\Resources\PengaturanmediaResource\Pages;

use App\Filament\Resources\PengaturanmediaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanmedia extends EditRecord
{
    protected static string $resource = PengaturanmediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

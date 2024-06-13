<?php

namespace App\Filament\Resources\CobaResource\Pages;

use App\Filament\Resources\CobaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoba extends EditRecord
{
    protected static string $resource = CobaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\SirkulasiarsipResource\Pages;

use App\Filament\Resources\SirkulasiarsipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSirkulasiarsip extends EditRecord
{
    protected static string $resource = SirkulasiarsipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

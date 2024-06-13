<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use App\Filament\Resources\DataarsipResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataarsip extends EditRecord
{
    protected static string $resource = DataarsipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

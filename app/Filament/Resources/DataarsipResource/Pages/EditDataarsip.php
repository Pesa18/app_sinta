<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use App\Models\Dataarsip;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DataarsipResource;

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

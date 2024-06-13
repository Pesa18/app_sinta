<?php

namespace App\Filament\Resources\SirkulasiarsipResource\Pages;

use App\Filament\Resources\SirkulasiarsipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSirkulasiarsips extends ListRecords
{
    protected static string $resource = SirkulasiarsipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

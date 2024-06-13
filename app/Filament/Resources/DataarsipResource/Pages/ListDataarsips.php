<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use App\Filament\Resources\DataarsipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataarsips extends ListRecords
{
    protected static string $resource = DataarsipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

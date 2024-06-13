<?php

namespace App\Filament\Resources\ImportdataResource\Pages;

use App\Filament\Resources\ImportdataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImportdatas extends ListRecords
{
    protected static string $resource = ImportdataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

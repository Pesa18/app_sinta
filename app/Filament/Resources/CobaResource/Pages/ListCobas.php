<?php

namespace App\Filament\Resources\CobaResource\Pages;

use App\Filament\Resources\CobaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCobas extends ListRecords
{
    protected static string $resource = CobaResource::class;
    protected static string $view = 'coba';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use App\Filament\Resources\ArsippegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArsippegawais extends ListRecords
{
    protected static string $resource = ArsippegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

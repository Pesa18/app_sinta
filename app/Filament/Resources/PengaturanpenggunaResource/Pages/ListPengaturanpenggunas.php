<?php

namespace App\Filament\Resources\PengaturanpenggunaResource\Pages;

use App\Filament\Resources\PengaturanpenggunaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanpenggunas extends ListRecords
{
    protected static string $resource = PengaturanpenggunaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

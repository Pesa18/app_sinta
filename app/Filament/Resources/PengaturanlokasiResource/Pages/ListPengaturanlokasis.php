<?php

namespace App\Filament\Resources\PengaturanlokasiResource\Pages;

use App\Filament\Resources\PengaturanlokasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanlokasis extends ListRecords
{
    protected static string $resource = PengaturanlokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

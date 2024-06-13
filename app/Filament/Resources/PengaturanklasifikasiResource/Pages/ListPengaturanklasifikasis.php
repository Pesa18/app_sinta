<?php

namespace App\Filament\Resources\PengaturanklasifikasiResource\Pages;

use App\Filament\Resources\PengaturanklasifikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanklasifikasis extends ListRecords
{
    protected static string $resource = PengaturanklasifikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

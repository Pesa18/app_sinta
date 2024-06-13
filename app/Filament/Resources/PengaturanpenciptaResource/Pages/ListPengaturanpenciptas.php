<?php

namespace App\Filament\Resources\PengaturanpenciptaResource\Pages;

use App\Filament\Resources\PengaturanpenciptaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanpenciptas extends ListRecords
{
    protected static string $resource = PengaturanpenciptaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

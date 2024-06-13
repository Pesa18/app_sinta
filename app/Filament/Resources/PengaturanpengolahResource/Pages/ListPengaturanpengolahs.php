<?php

namespace App\Filament\Resources\PengaturanpengolahResource\Pages;

use App\Filament\Resources\PengaturanpengolahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanpengolahs extends ListRecords
{
    protected static string $resource = PengaturanpengolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

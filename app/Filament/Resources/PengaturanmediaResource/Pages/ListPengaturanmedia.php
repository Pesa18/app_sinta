<?php

namespace App\Filament\Resources\PengaturanmediaResource\Pages;

use App\Filament\Resources\PengaturanmediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanmedia extends ListRecords
{
    protected static string $resource = PengaturanmediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

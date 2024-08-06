<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Support\Facades\FilamentAsset;
use App\Filament\Resources\DataarsipResource;

class CreateDataarsip extends CreateRecord
{
    protected static string $resource = DataarsipResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    public function mount(): void
    {
        parent::mount();
    }
    public function getTitle(): string | Htmlable
    {
        return "Buat Data Arsip";
    }
}

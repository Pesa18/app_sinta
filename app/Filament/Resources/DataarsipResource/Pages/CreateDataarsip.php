<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Facades\FilamentAsset;
use App\Filament\Resources\DataarsipResource;

class CreateDataarsip extends CreateRecord
{
    protected static string $resource = DataarsipResource::class;

    public function mount(): void
    {
        parent::mount();
    }
}

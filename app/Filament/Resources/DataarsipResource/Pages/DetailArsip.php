<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\DataarsipResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class DetailArsip extends Page
{

    use InteractsWithRecord;
    protected static string $resource = DataarsipResource::class;

    protected static string $view = 'filament.resources.dataarsip-resource.pages.detail-arsip';


    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}

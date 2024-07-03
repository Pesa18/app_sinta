<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use App\Models\Dataarsip;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DataarsipResource;

class EditDataarsip extends EditRecord
{
    protected static string $resource = DataarsipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(function (Dataarsip $record) {
                // delete single
                if ($record->file_arsip) {
                    Storage::disk('public')->delete($record->file_arsip);
                }
                // // delete multiple
                // if ($record->galery) {
                //     foreach ($record->galery as $ph) Storage::disk('public')->delete($ph);
                // }
            }),
        ];
    }
}

<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Actions;
use App\Models\Dataarsip;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
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
    protected function mutateFormDataBeforeSave(array $data): array
    {


        $record = $this->record;

        // Check if a new file is being uploaded
        if (isset($data['file_arsip']) && $data['file_arsip'] !== $record->file_arsip) {
            // Delete the old file
            if ($record->file_arsip) {
                Storage::disk('public')->delete($record->file_arsip);
            }
        }
        return $data;
    }


    public static function getGlobalSearchResultTitle(Dataarsip $record): string | Htmlable
    {
        return $record->noarsip;
    }
}

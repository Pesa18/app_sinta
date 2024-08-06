<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Storage;
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
        $this->record['file_size'] = $this->showFileSize($this->record->file_arsip);
        $this->record['file_name'] = basename($this->record->file_arsip);
    }

    private function showFileSize($file)
    {
        try {
            $filePath = $file; // Sesuaikan path dengan file yang ingin Anda ukur
            $fileSize = Storage::disk('public')->size($filePath);

            return  $this->humanFileSize($fileSize);
        } catch (\Throwable $th) {
            return 0;
        }
    }

    private function humanFileSize($size, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $base = log($size, 1024);
        $suffix = $units[floor($base)];

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffix;
    }
}

<?php

namespace App\Filament\Resources\ArsippegawaiResource\Pages;

use Filament\Actions;
use App\Imports\ArsipPegawaiImport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ArsippegawaiResource;

class ListArsippegawais extends ListRecords
{
    protected static string $resource = ArsippegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getHeader(): ?View
    {
        return view('filament.headerArsippegawai');
    }

    public $file = '';


    public function saveImport()
    {
        $this->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx|max:2048',
        ], [
            'file.required' => 'File harus diunggah.',
            'file.mimes' => 'File harus berupa file CSV, TXT, atau XLSX.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        try {
            Excel::import(new ArsipPegawaiImport, $this->file);
            Notification::make()
                ->title('Data Berhasil Diimport')
                ->success()
                ->send();
            $this->reset(['file']);
        } catch (\Exception $e) {
            Notification::make()
                ->title($e->getMessage())
                ->danger()
                ->send();
        }
    }
}

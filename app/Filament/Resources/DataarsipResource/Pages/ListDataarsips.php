<?php

namespace App\Filament\Resources\DataarsipResource\Pages;

use Filament\Forms;
use Filament\Actions;
use App\Imports\ArsipImport;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DataarsipResource;
use Filament\Notifications\Notification;

class ListDataarsips extends ListRecords
{

    use WithFileUploads;
    protected static string $resource = DataarsipResource::class;

    public function getBreadcrumb(): ?string
    {
        return "List Arsip";
    }

    public function getHeader(): ?View
    {
        return view('filament.headerDataarsip');
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
            Excel::import(new ArsipImport, $this->file);
            Notification::make()
                ->title('Data Berhasil Diimport')
                ->success()
                ->send();
            $this->reset(['file']);
        } catch (\Exception $e) {
            Notification::make()
                ->title("Error: " . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}

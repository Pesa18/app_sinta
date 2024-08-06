<?php

namespace App\Filament\Resources\PengaturanpengolahResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengaturanpengolahResource;
use App\Models\Masterpengolah;

class ListPengaturanpengolahs extends ListRecords
{
    protected static string $resource = PengaturanpengolahResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("Buat Pengolah")->form([
                Repeater::make('nama_pengolah')
                    ->schema([
                        TextInput::make('nama_pengolah')->label('Nama Pengolah')->required(),

                    ])->addActionLabel('Tambah Pengolah')
            ])->action(function (array $data): void {
                try {
                    Masterpengolah::insert($data['nama_pengolah']);
                    Notification::make()
                        ->title(count($data['nama_pengolah']) . ' Data Berhasil Disimpan')
                        ->success()
                        ->send();
                } catch (\Throwable $th) {
                    Notification::make()
                        ->title($th->getMessage())
                        ->danger()
                        ->send();
                }
            })
        ];
    }
}

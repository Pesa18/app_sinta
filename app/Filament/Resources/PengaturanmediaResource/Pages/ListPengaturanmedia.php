<?php

namespace App\Filament\Resources\PengaturanmediaResource\Pages;

use Filament\Actions;
use App\Models\Mastermedia;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengaturanmediaResource;

class ListPengaturanmedia extends ListRecords
{
    protected static string $resource = PengaturanmediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("Buat Media")->form([
                Repeater::make('nama_media')
                    ->schema([
                        TextInput::make('nama_media')->label('Nama Media')->required(),

                    ])->addActionLabel('Tambah Media')
            ])->action(function (array $data): void {
                try {
                    Mastermedia::insert($data['nama_media']);
                    Notification::make()
                        ->title(count($data['nama_media']) . ' Data Berhasil Disimpan')
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

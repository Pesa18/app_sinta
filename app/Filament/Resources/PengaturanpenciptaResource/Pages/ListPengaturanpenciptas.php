<?php

namespace App\Filament\Resources\PengaturanpenciptaResource\Pages;

use Filament\Actions;
use App\Models\Masterpencipta;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengaturanpenciptaResource;

class ListPengaturanpenciptas extends ListRecords
{
    protected static string $resource = PengaturanpenciptaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("Buat Pencipta")->form([
                Repeater::make('nama_pencipta')
                    ->schema([
                        TextInput::make('nama_pencipta')->label('Nama Pencipta')->required(),

                    ])->addActionLabel('Tambah Pencipta')
            ])->action(function (array $data): void {
                try {
                    Masterpencipta::insert($data['nama_pencipta']);
                    Notification::make()
                        ->title(count($data['nama_pencipta']) . ' Data Berhasil Disimpan')
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

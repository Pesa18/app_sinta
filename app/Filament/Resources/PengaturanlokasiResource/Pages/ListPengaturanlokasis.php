<?php

namespace App\Filament\Resources\PengaturanlokasiResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PengaturanlokasiResource;
use App\Models\Masterlokasi;
use Filament\Notifications\Notification;

class ListPengaturanlokasis extends ListRecords
{
    protected static string $resource = PengaturanlokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make("Buat Lokasi")->form([
                Repeater::make('nama_lokasi')
                    ->schema([
                        TextInput::make('nama_lokasi')->label('Nama Lokasi')->required(),

                    ])->addActionLabel('Tambah Lokasi')
            ])->action(function (array $data): void {
                try {
                    Masterlokasi::insert($data['nama_lokasi']);
                    Notification::make()
                        ->title(count($data['nama_lokasi']) . ' Data Berhasil Disimpan')
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
